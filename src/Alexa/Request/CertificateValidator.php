<?php

namespace InternetOfVoice\LibVoice\Alexa\Request;

use \DateTime;
use \Exception;
use \InvalidArgumentException;

/**
 * Class CertificateValidator
 *
 * @license http://opensource.org/licenses/MIT
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @author  Emanuele Corradini <emanuele@evensi.com>
 * @author  Mathias Hansen <me@codemonkey.io>
 * @author  Jakub Suchy <info@jsuchy.cz>
 */
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
		$this->certificateUrl   = $certificateUrl;
		$this->requestSignature = $signature;
	}

	/**
	 * @param string $requestData
	 * @param bool   $checkTimeStamp MUST be true for production, see Amazons policy on verifying requests
	 *
	 * @return  bool
	 * @see     https://developer.amazon.com/public/solutions/alexa/alexa-skills-kit/docs/developing-an-alexa-skill-as-a-web-service#verifying-that-the-request-was-sent-by-alexa
	 * @throws  Exception
	 * @codeCoverageIgnore
	 */
	public function validateRequest($requestData, $checkTimeStamp = true) {
		$requestParsed = json_decode($requestData, true);

		if ($checkTimeStamp) {
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
	 * @return bool
	 * @throws InvalidArgumentException
	 * @throws Exception
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

		return true;
	}

	/**
	 * @return bool
	 * @throws InvalidArgumentException
	 * @codeCoverageIgnore
	 */
	public function validateCertificate() {
		$this->certificateContent = $this->fetchCertificate();
		$parsedCertificate        = $this->parseCertificate($this->certificateContent);

		if ($parsedCertificate == null ||
		    !$this->validateCertificateDate($parsedCertificate) ||
		    !$this->validateCertificateSAN($parsedCertificate, static::ECHO_SERVICE_DOMAIN)
		) {
			throw new InvalidArgumentException('Certificate does not contain a valid SAN, is expired or was not found.');
		}

		return true;
	}

	/**
	 * @param string $requestData
	 * @return bool
	 * @throws InvalidArgumentException
	 * @codeCoverageIgnore
	 */
	public function validateRequestSignature($requestData) {
		$certKey = openssl_pkey_get_public($this->certificateContent);
		$valid   = openssl_verify($requestData, base64_decode($this->requestSignature), $certKey, self::ENCRYPT_METHOD);
		if (!$valid) {
			throw new InvalidArgumentException('Request signature could not be verified');
		}

		return true;
	}

	/**
	 * @param array $parsedCertificate
	 * @return bool
	 */
	public function validateCertificateDate(array $parsedCertificate) {
		$validFrom = $parsedCertificate['validFrom_time_t'];
		$validTo   = $parsedCertificate['validTo_time_t'];
		$time      = time();

		return ($validFrom <= $time && $time <= $validTo);
	}

	/**
	 * @param  array  $parsedCertificate
	 * @param  string $amazonServiceDomain
	 * @return bool
	 * @codeCoverageIgnore
	 */
	public function validateCertificateSAN(array $parsedCertificate, $amazonServiceDomain) {
		if (strpos($parsedCertificate['extensions']['subjectAltName'], $amazonServiceDomain) === false) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * @return bool
	 * @throws InvalidArgumentException
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

		return true;
	}


	/**
	 * @param mixed $certificate
	 * @return array
	 */
	public function parseCertificate($certificate) {
		return openssl_x509_parse($certificate);
	}

	/**
	 * @return mixed
	 */
	public function fetchCertificate() {
		$curlHandle = curl_init();
		curl_setopt($curlHandle, CURLOPT_URL, $this->certificateUrl);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curlHandle);
		curl_close($curlHandle);

		return $result;
	}
}
