<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Context\System;

use stdClass;

/**
 * Class Device
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Device {
	/** @var string $deviceId */
	protected $deviceId;

	/** @var stdClass $supportedInterfaces */
	protected $supportedInterfaces;


	/**
	 * @param array $deviceData
	 */
	public function __construct($deviceData) {
		if (isset($deviceData['deviceId'])) {
			$this->deviceId = $deviceData['deviceId'];
		}

		if (isset($deviceData['supportedInterfaces'])) {
			$this->supportedInterfaces = json_decode(json_encode($deviceData['supportedInterfaces']));
		}
	}


	/**
	 * @return string
	 */
	public function getDeviceId() {
		return $this->deviceId;
	}

	/**
	 * @return stdClass
	 */
	public function getSupportedInterfaces() {
		return $this->supportedInterfaces;
	}
}
