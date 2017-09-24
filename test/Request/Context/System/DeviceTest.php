<?php

namespace Tests\Request;

use \Alexa\Request\Context\System\Device;
use \PHPUnit\Framework\TestCase;


class DeviceTest extends TestCase {
	/**
	 * testDevice
	 */
	public function testDevice() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../../../Fixtures/IntentRequest-Body.txt'), true);
		$device = new Device($fixture['context']['System']['device']);
		$this->assertStringStartsWith('amzn1.ask.device.', $device->getDeviceId());
        $this->assertObjectHasAttribute('AudioPlayer', $device->getSupportedInterfaces());
	}
}
