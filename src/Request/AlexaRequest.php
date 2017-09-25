<?php

namespace Alexa\Request;

use \InvalidArgumentException;

class AlexaRequest
{
	/** @var string $rawData */
	protected $rawData;

	/** @var array $data */
	protected $data;


	/** @var string $version */
	protected $version;

	/** @var Session $session */
	protected $session;

	/** @var Context $context */
	protected $context;

	// @TODO RequestType


	/**
	 * @param   string      $rawData
	 * @param   array       $validApplicationIds
	 * @param   string      $signatureCertChainUrl
	 * @param   string      $signature
	 * @param   bool        $checkRequestTimestamp
	 *
	 * @throws  InvalidArgumentException
	 */
	public function __construct(
		$rawData,
		$validApplicationIds,
		$signatureCertChainUrl,
		$signature,
		$checkRequestTimestamp = true
	) {
		// Handle request data
		$this->rawData = $rawData;
		$this->data = json_decode($rawData, true);
		if (is_null($this->data)) {
			throw new InvalidArgumentException('AlexaRequest requires raw JSON data.');
		}

		$this->version = $this->data['version'];

		// Expect either a Session or a Context object
		if (isset($this->data['session'])) {
			$this->session = new Session($this->data['session']);
		} elseif (isset($this->data['context'])) {
			$this->context = new Context($this->data['context']);
		} else {
			throw new InvalidArgumentException('AlexaRequest expects a Session or Context object.');
		}

		// Validate ApplicationId
		if (!is_array($validApplicationIds) && count($validApplicationIds) < 1) {
			throw new InvalidArgumentException('AlexaRequest requires at least one valid applicationId.');
		}

		if (false === $this->getApplication()->validateApplicationId($validApplicationIds)) {
			throw new InvalidArgumentException('ApplicationIds do not match.');
		}

		// Validate certificate
		$certificateValidator = new CertificateValidator($signatureCertChainUrl, $signature);
        if (false === $certificateValidator->validateRequest($rawData, $checkRequestTimestamp)) {
            throw new InvalidArgumentException('Certificate is not valid.');
        }

		// @TODO RequestType
	}


	/**
	 * @return string
	 */
	public function getRawData() {
		return $this->rawData;
	}

	/**
	 * @return array
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * @return string
	 */
	public function getVersion() {
		return $this->version;
	}

	/**
	 * @return Session
	 */
	public function getSession() {
		return $this->session;
	}

	/**
	 * @return Context
	 */
	public function getContext() {
		return $this->context;
	}

	// @TODO RequestType

	/**
	 * Shortcut to Application object, either provided by Session or by Context
	 *
	 * @return Application
	 */
	public function getApplication() {
		if(!is_null($this->session)) {
			return $this->session->getApplication();
		} else {
			return $this->context->getSystem()->getApplication();
		}
	}

	/**
	 * Shortcut to User object, either provided by Session or by Context
	 *
	 * @return User
	 */
	public function getUser() {
		if(!is_null($this->session)) {
			return $this->session->getUser();
		} else {
			return $this->context->getSystem()->getUser();
		}
	}
}
