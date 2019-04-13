<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Context\System;

use \InternetOfVoice\LibVoice\Alexa\Request\Context\System\Device\SupportedInterfaces;

/**
 * Class Device
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Device {
	/** @var string $deviceId */
	protected $deviceId;

	/** @var SupportedInterfaces $supportedInterfaces */
	protected $supportedInterfaces;


	/**
	 * @param array $deviceData
	 */
	public function __construct($deviceData) {
		if (isset($deviceData['deviceId'])) {
			$this->deviceId = $deviceData['deviceId'];
		}

		if (isset($deviceData['supportedInterfaces'])) {
			$this->supportedInterfaces = new SupportedInterfaces($deviceData['supportedInterfaces']);
		}
	}


	/**
	 * @return string
	 */
	public function getDeviceId() {
		return $this->deviceId;
	}

	/**
	 * @return SupportedInterfaces
	 */
	public function getSupportedInterfaces() {
		return $this->supportedInterfaces;
	}
}
