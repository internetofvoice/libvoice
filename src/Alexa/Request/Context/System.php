<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Context;

use \InternetOfVoice\LibVoice\Alexa\Request\Application;
use \InternetOfVoice\LibVoice\Alexa\Request\Context\System\Device;
use \InternetOfVoice\LibVoice\Alexa\Request\User;

/**
 * Class System
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class System {
	/** @var Application $application */
	protected $application;

	/** @var User $user */
	protected $user;

	/** @var Device $device */
	protected $device;

	/** @var string $apiEndpoint */
	protected $apiEndpoint;

	/** @var string $apiEndpoint */
	protected $apiAccessToken;

	/** @var bool $supportsAlexaCameraPhotoCaptureController */
	protected $supportsAlexaCameraPhotoCaptureController = false;

	/** @var bool $supportsAlexaCameraVideoCaptureController */
	protected $supportsAlexaCameraVideoCaptureController = false;

	/** @var bool $supportsAlexaPresentationAPL */
	protected $supportsAlexaPresentationAPL = false;

	/** @var bool $supportsAudioPlayer */
	protected $supportsAudioPlayer = false;

	/** @var bool $supportsDisplay */
	protected $supportsDisplay = false;

	/** @var bool $supportsGeolocation */
	protected $supportsGeolocation = false;

	/** @var bool $supportsVideoApp */
	protected $supportsVideoApp = false;

	// $supportsPlaybackController?
	// $supportsGadgetController?
	// $supportsGameEngine?


	/**
	 * @param array $systemData
	 */
	public function __construct(array $systemData) {
		if (isset($systemData['application'])) {
			$this->application = new Application($systemData['application']);
		}

		if (isset($systemData['user'])) {
			$this->user = new User($systemData['user']);
		}

		if (isset($systemData['device'])) {
			$this->device = new Device($systemData['device']);

			if(isset($this->device->getSupportedInterfaces()['Alexa.Camera.PhotoCaptureController'])) {
				$this->supportsAlexaCameraPhotoCaptureController = true;
			}

			if(isset($this->device->getSupportedInterfaces()['Alexa.Camera.VideoCaptureController'])) {
				$this->supportsAlexaCameraVideoCaptureController = true;
			}

			if(isset($this->device->getSupportedInterfaces()['Alexa.Presentation.APL'])) {
				$this->supportsAlexaPresentationAPL = true;
			}

			if(isset($this->device->getSupportedInterfaces()['AudioPlayer'])) {
				$this->supportsAudioPlayer = true;
			}

			if(isset($this->device->getSupportedInterfaces()['Display'])) {
				$this->supportsDisplay = true;
			}

			if(isset($this->device->getSupportedInterfaces()['Geolocation'])) {
				$this->supportsGeolocation = true;
			}

			if(isset($this->device->getSupportedInterfaces()['VideoApp'])) {
				$this->supportsVideoApp = true;
			}
		}

		if (isset($systemData['apiEndpoint'])) {
			$this->apiEndpoint = $systemData['apiEndpoint'];
		}

		if (isset($systemData['apiAccessToken'])) {
			$this->apiAccessToken = $systemData['apiAccessToken'];
		}
	}


	/**
	 * @return Application
	 */
	public function getApplication(): Application {
		return $this->application;
	}

	/**
	 * @return User
	 */
	public function getUser(): User {
		return $this->user;
	}

	/**
	 * @return Device
	 */
	public function getDevice(): Device {
		return $this->device;
	}

	/**
	 * @return string
	 */
	public function getApiEndpoint(): string {
		return $this->apiEndpoint;
	}

	/**
	 * @return string
	 */
	public function getApiAccessToken(): string {
		return $this->apiAccessToken;
	}

	/**
	 * @return bool
	 */
	public function supportsAlexaCameraPhotoCaptureController(): bool {
		return $this->supportsAlexaCameraPhotoCaptureController;
	}

	/**
	 * @return bool
	 */
	public function supportsAlexaCameraVideoCaptureController(): bool {
		return $this->supportsAlexaCameraVideoCaptureController;
	}

	/**
	 * @return bool
	 */
	public function supportsAlexaPresentationAPL(): bool {
		return $this->supportsAlexaPresentationAPL;
	}

	/**
	 * @return bool
	 */
	public function supportsAudioPlayer(): bool {
		return $this->supportsAudioPlayer;
	}

	/**
	 * @return bool
	 */
	public function supportsDisplay(): bool {
		return $this->supportsDisplay;
	}

	/**
	 * @return bool
	 */
	public function supportsGeolocation(): bool {
		return $this->supportsGeolocation;
	}

	/**
	 * @return bool
	 */
	public function supportsVideoApp(): bool {
		return $this->supportsVideoApp;
	}

}
