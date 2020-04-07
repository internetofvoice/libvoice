<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Context\System;

/**
 * Class Device
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Device {
	/** @var string $deviceId */
	protected $deviceId;

	/** @var array $supportedInterfaces */
	protected $supportedInterfaces;


	/**
	 * @param array $deviceData
	 */
	public function __construct(array $deviceData) {
		if (isset($deviceData['deviceId'])) {
			$this->deviceId = $deviceData['deviceId'];
		}

		if (isset($deviceData['supportedInterfaces'])) {
			$this->supportedInterfaces = $deviceData['supportedInterfaces'];
		}
	}


	/**
	 * @return string
	 */
	public function getDeviceId(): string {
		return $this->deviceId;
	}

	/**
	 * @return array
	 */
	public function getSupportedInterfaces(): array {
		return $this->supportedInterfaces;
	}
}
