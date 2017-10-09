<?php

namespace InternetOfVoice\LibVoice\Alexa\Request;

use InvalidArgumentException;
use InternetOfVoice\LibVoice\Alexa\Request\Request\AbstractRequest;
use InternetOfVoice\LibVoice\Alexa\Request\Request\IntentRequest;
use InternetOfVoice\LibVoice\Alexa\Request\Request\Intent\Intent;
use InternetOfVoice\LibVoice\Alexa\Request\Request\LaunchRequest;
use InternetOfVoice\LibVoice\Alexa\Request\Request\SessionEndedRequest;

/**
 * Class AlexaRequest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class AlexaRequest {
	/** @var array $data */
	protected $data;

	/** @var string $version */
	protected $version;

	/** @var Session $session */
	protected $session;

	/** @var Context $context */
	protected $context;

	/** @var AbstractRequest $request */
	protected $request;


	/**
	 * @param string $rawData
	 * @param array  $validAppIds
	 * @param string $signatureCertChainUrl
	 * @param string $signature
	 * @param bool   $checkTimestamp
	 */
	public function __construct($rawData, $validAppIds, $signatureCertChainUrl, $signature, $checkTimestamp = true) {
		// Request data
		$this->data = json_decode($rawData, true);
		if (is_null($this->data)) {
			throw new InvalidArgumentException('AlexaRequest requires raw JSON data.');
		}

		// Validate Certificate
		$certificateValidator = new CertificateValidator($signatureCertChainUrl, $signature);
		$certificateValidator->validateRequest($rawData, $checkTimestamp);

		// Request version
		$this->version = $this->data['version'];

		// Session and Context
		if (isset($this->data['session'])) {
			$this->session = new Session($this->data['session']);
		} elseif (isset($this->data['context'])) {
			$this->context = new Context($this->data['context']);
		} else {
			throw new InvalidArgumentException('AlexaRequest expects a Session or Context object.');
		}

		// Validate Application
		if (!is_array($validAppIds) || count($validAppIds) < 1) {
			throw new InvalidArgumentException('AlexaRequest requires at least one valid applicationId.');
		}

		if (false === $this->getApplication()->validateApplicationId($validAppIds)) {
			throw new InvalidArgumentException('ApplicationId does not match.');
		}

		// Create request object
		$this->createRequestFromType();
	}


	/**
	 * @throws InvalidArgumentException
	 */
	private function createRequestFromType() {
		if (!isset($this->data['request']['type'])) {
			throw new InvalidArgumentException('AlexaRequest requires a Request type.');
		}

		switch ($this->data['request']['type']) {
			case 'LaunchRequest':
				/** @var LaunchRequest request */
				$this->request = new LaunchRequest($this->data['request']);
			break;

			case 'SessionEndedRequest':
				/** @var SessionEndedRequest request */
				$this->request = new SessionEndedRequest($this->data['request']);
			break;

			case 'IntentRequest':
				/** @var IntentRequest request */
				$this->request = new IntentRequest($this->data['request']);
			break;

			default:
				throw new InvalidArgumentException('Unknown Request type "' . $this->data['request']['type'] . '"');
			break;
		}
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

	/**
	 * @return AbstractRequest
	 */
	public function getRequest() {
		return $this->request;
	}

	/**
	 * Shortcut to Application object, either provided by Session or by Context
	 *
	 * @return Application
	 */
	public function getApplication() {
		if (!is_null($this->session)) {
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
		if (!is_null($this->session)) {
			return $this->session->getUser();
		} else {
			return $this->context->getSystem()->getUser();
		}
	}

	/**
	 * Shortcut to Intent object
	 *
	 * @return Intent
	 */
	public function getIntent() {
		if($this->getRequest()->getType() != 'IntentRequest') {
			throw new InvalidArgumentException('This request is not an IntentRequest.');
		}

		/** @var IntentRequest $request */
		$request = $this->getRequest();
		return $request->getIntent();
	}
}
