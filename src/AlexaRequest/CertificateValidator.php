<?php

namespace InternetOfVoice\LibVoice\AlexaRequest;

use DateTime;
use InvalidArgumentException;
use RuntimeException;

class CertificateValidator {
	const TIMESTAMP_VALID_TOLERANCE_SECONDS = 150;
	const SIGNATURE_VALID_PROTOCOL = 'https';
	const SIGNATURE_VALID_HOSTNAME = 's3.amazonaws.com';
	const SIGNATURE_VALID_PATH = '/echo.api/';
	const SIGNATURE_VALID_PORT = 443;
	const ECHO_SERVICE_DOMAIN = 'echo-api.amazon.com';
	const ENCRYPT_METHOD = 'sha1WithRSAEncryption';

	/** @var string $certificateUrl */
	protected $certificateUrl;

	/** @var string $requestSignature */
	protected $requestSignature;

	/** @var mixed $certificateContent */
	protected $certificateContent;


	/**
	 * @param string $certificateUrl
	 * @param string $signature
	 */
	public function __construct($certificateUrl, $signature) {
		$this->certificateUrl = $certificateUrl;
		$this->requestSignature = $signature;
	}

	/**
	 * @param   string  $requestData
	 * @param   bool    $checkTimeStamp     MUST be true for production, see Amazons policy on verifying requests
	 *
     * @return  bool
	 * @see     https://developer.amazon.com/public/solutions/alexa/alexa-skills-kit/docs/developing-an-alexa-skill-as-a-web-service#verifying-that-the-request-was-sent-by-alexa
	 */
	public function validateRequest($requestData, $checkTimeStamp = true) {
		$requestParsed = json_decode($requestData, true);

		if($checkTimeStamp) {
			$this->validateTimestamp($requestParsed['request']['timestamp']);
		}

		$this->verifySignatureCertificateURL();
		$this->validateCertificate();
		$this->validateRequestSignature($requestData);

        return true;
	}

	/**
	 * @param string $timestamp
	 *
	 * @throws InvalidArgumentException
	 */
	public function validateTimestamp($timestamp) {
		if (is_numeric($timestamp)) {
			$timestamp = '@' . substr($timestamp, 0, 10);
		}

		$tsReq = new DateTime($timestamp);
		$tsNow = new DateTime;
		$diff  = $tsNow->getTimestamp() - $tsReq->getTimestamp();
		if ($diff > self::TIMESTAMP_VALID_TOLERANCE_SECONDS) {
			throw new InvalidArgumentException('Request timestamp was too old. Possible replay attack.');
		}
	}

	public function validateCertificate() {
		$this->certificateContent = $this->getCertificate();
		$parsedCertificate        = $this->parseCertificate($this->certificateContent);

		if ($parsedCertificate == null ||
		    !$this->validateCertificateDate($parsedCertificate) ||
		    !$this->validateCertificateSAN($parsedCertificate, static::ECHO_SERVICE_DOMAIN)
		) {
			throw new InvalidArgumentException('Certificate does not contain a valid SAN, is expired or was not found.');
		}
	}

	/*
	 * @params $requestData
	 *
	 * @throws InvalidArgumentException
	 */
	public function validateRequestSignature($requestData) {
		$certKey = openssl_pkey_get_public($this->certificateContent);
		$valid = openssl_verify($requestData, base64_decode($this->requestSignature), $certKey, self::ENCRYPT_METHOD);
		if (!$valid) {
			throw new InvalidArgumentException('Request signature could not be verified');
		}
	}

	/**
	 * Returns true if the certificate is not expired.
	 *
	 * @param array $parsedCertificate
	 *
	 * @return boolean
	 */
	public function validateCertificateDate(array $parsedCertificate) {
		$validFrom = $parsedCertificate['validFrom_time_t'];
		$validTo   = $parsedCertificate['validTo_time_t'];
		$time      = time();

		return ($validFrom <= $time && $time <= $validTo);
	}

	/**
	 * Returns true if the configured service domain is present/valid, false if invalid/not present
	 *
	 * @param array  $parsedCertificate
	 * @param string $amazonServiceDomain
	 *
	 * @return boolean
	 */
	public function validateCertificateSAN(array $parsedCertificate, $amazonServiceDomain) {
		if (strpos($parsedCertificate['extensions']['subjectAltName'], $amazonServiceDomain) === false) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * Verify URL of the certificate
	 * @throws InvalidArgumentException
	 * @author Emanuele Corradini <emanuele@evensi.com>
	 */
	public function verifySignatureCertificateURL() {
		$url = parse_url($this->certificateUrl);

		if ($url['scheme'] !== static::SIGNATURE_VALID_PROTOCOL) {
			throw new InvalidArgumentException('Protocol is not secure.');
		} else if ($url['host'] !== static::SIGNATURE_VALID_HOSTNAME) {
			throw new InvalidArgumentException('Certificate origin is not Amazon.');
		} else if (strpos($url['path'], static::SIGNATURE_VALID_PATH) !== 0) {
			throw new InvalidArgumentException('Certificate path not valid.');
		} else if (isset($url['port']) && $url['port'] !== static::SIGNATURE_VALID_PORT) {
			throw new InvalidArgumentException('Certificate port not valid.');
		}
	}


	/**
	 * Parse the X509 certificate
	 *
	 * @param $certificate CertificateValidator contents
	 *
	 * @return array
	 */
	public function parseCertificate($certificate) {
		return openssl_x509_parse($certificate);
	}

	/**
	 * Return the certificate to the underlying code by fetching it from its location.
	 * Override this function if you wish to cache the certificate for a specific time.
	 */
	public function getCertificate() {
		return $this->fetchCertificate();
	}

	/**
	 * Perform the actual download of the certificate
	 * @return mixed
	 */
	public function fetchCertificate() {
		if (!function_exists('curl_init')) {
			throw new RuntimeException('CURL extension is required to download the Certificate.');
		}

		$curlHandle = curl_init();
		curl_setopt($curlHandle, CURLOPT_URL, $this->certificateUrl);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curlHandle);
		curl_close($curlHandle);

		return $result;
	}
}
