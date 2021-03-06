<?php

namespace InternetOfVoice\LibVoice\Alexa\Request;

use \Exception;
use \InvalidArgumentException;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\AbstractRequest;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\AudioPlayer\PlaybackFailed;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\AudioPlayer\PlaybackFinished;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\AudioPlayer\PlaybackNearlyFinished;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\AudioPlayer\PlaybackStarted;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\AudioPlayer\PlaybackStopped;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\Display\ElementSelected;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\GameEngine\InputHandlerEvent;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\CanFulfillIntentRequest;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\IntentRequest;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\Intent\Intent;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\LaunchRequest;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\PlaybackController\NextCommandIssued;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\PlaybackController\PauseCommandIssued;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\PlaybackController\PlayCommandIssued;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\PlaybackController\PreviousCommandIssued;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\SessionEndedRequest;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\System\ExceptionEncountered;

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
	 * @param bool   $checkTimestamp   please see comment on Certificate Validation below
	 * @param bool   $checkCertificate please see comment on Certificate Validation below
	 *
	 * @throws Exception
	 */
	public function __construct(
	    $rawData,
        $validAppIds,
        $signatureCertChainUrl,
        $signature,
        $checkTimestamp = true,
        $checkCertificate = true
    ) {
		// Request data
		$this->data = json_decode($rawData, true);
		if (is_null($this->data)) {
			throw new InvalidArgumentException('AlexaRequest requires raw JSON data.');
		}

		// Certificate Validation. For development (NEVER in production!) you may use two bypasses:
        // 1. $checkCertificate => false: full bypass - no certificate / signature checks at all
        // 2. $checkTimestamp   => false: bypass only timestamp checking
        //
        // This is useful for unit tests. Your fixtures will have timestamps in the past and thus timestamp
        // checking will fail - use timestamp check bypassing by setting $checkTimestamp to false.
        // If you are not able to produce fixtures without breaking the request signature, you may use
        // full bypass by setting $checkCertificate to false. Please be aware that this should be used with
        // caution and NEVER in production, as proper certificate validation is required (and tested) by Amazon.
        //
        // ** If your production skill accepts request with a wrong signature, it will not be certified (go live). **
        if($checkCertificate) {
            $certificateValidator = new CertificateValidator($signatureCertChainUrl, $signature);
            $certificateValidator->validateRequest($rawData, $checkTimestamp);
        }

		// Request version
		$this->version = $this->data['version'];

		// Session and Context
		if(!isset($this->data['session']) && !isset($this->data['context'])) {
			throw new InvalidArgumentException('AlexaRequest expects a Session or Context object.');
		}

		if(isset($this->data['session'])) {
			$this->session = new Session($this->data['session']);
		}

		if(isset($this->data['context'])) {
			$this->context = new Context($this->data['context']);
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
			// Standard requests
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

			case 'CanFulfillIntentRequest':
				/** @var CanFulfillIntentRequest request */
				$this->request = new IntentRequest($this->data['request']);
			break;


			// AudioPlayer requests
			case 'AudioPlayer.PlaybackFailed':
				/** @var PlaybackFailed request */
				$this->request = new PlaybackFailed($this->data['request']);
			break;

			case 'AudioPlayer.PlaybackFinished':
				/** @var PlaybackFinished request */
				$this->request = new PlaybackFinished($this->data['request']);
			break;

			case 'AudioPlayer.PlaybackNearlyFinished':
				/** @var PlaybackNearlyFinished request */
				$this->request = new PlaybackNearlyFinished($this->data['request']);
			break;

			case 'AudioPlayer.PlaybackStarted':
				/** @var PlaybackStarted request */
				$this->request = new PlaybackStarted($this->data['request']);
			break;

			case 'AudioPlayer.PlaybackStopped':
				/** @var PlaybackStopped request */
				$this->request = new PlaybackStopped($this->data['request']);
			break;


			// Display requests
			case 'Display.ElementSelected':
				/** @var ElementSelected request */
				$this->request = new ElementSelected($this->data['request']);
			break;


			// GameEngine requests
			case 'GameEngine.InputHandlerEvent':
				/** @var InputHandlerEvent request */
				$this->request = new InputHandlerEvent($this->data['request']);
			break;


			// PlaybackController requests
			case 'PlaybackController.NextCommandIssued':
				/** @var NextCommandIssued request */
				$this->request = new NextCommandIssued($this->data['request']);
			break;

			case 'PlaybackController.PauseCommandIssued':
				/** @var PauseCommandIssued request */
				$this->request = new PauseCommandIssued($this->data['request']);
			break;

			case 'PlaybackController.PlayCommandIssued':
				/** @var PlayCommandIssued request */
				$this->request = new PlayCommandIssued($this->data['request']);
			break;

			case 'PlaybackController.PreviousCommandIssued':
				/** @var PreviousCommandIssued request */
				$this->request = new PreviousCommandIssued($this->data['request']);
			break;


			case 'System.ExceptionEncountered':
				/** @var ExceptionEncountered request */
				$this->request = new ExceptionEncountered($this->data['request']);
			break;


			default:
				throw new InvalidArgumentException('Unknown Request type "' . $this->data['request']['type'] . '"');
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
