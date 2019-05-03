<?php

namespace Tests\Alexa\Request\Context\System;

use \InternetOfVoice\LibVoice\Alexa\Request\Context\System\Device;
use \PHPUnit\Framework\TestCase;

/**
 * Class DeviceTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class DeviceTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testDevice() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/IntentRequest-Body.txt'), true);
		$device = new Device($fixture['context']['System']['device']);
		$this->assertStringStartsWith('amzn1.ask.device.', $device->getDeviceId());
        $this->assertArrayHasKey('AudioPlayer', $device->getSupportedInterfaces());
	}
}
