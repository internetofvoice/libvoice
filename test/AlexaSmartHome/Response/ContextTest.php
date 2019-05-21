<?php

namespace Tests\AlexaSmartHome\Response;

use \DateTime;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\ReportableProperty;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Context;
use \PHPUnit\Framework\TestCase;

/**
 * Class ContextTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ContextTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testContext() {
		$time     = new DateTime('2017-01-01 00:00:00+01:00');
		$property = new ReportableProperty('Alexa.BrightnessController', 'brightness', 100, $time);
		$context  = new Context([$property]);
		$expect   = [
			'properties' => [[
				'namespace' => 'Alexa.BrightnessController',
				'name' => 'brightness',
				'value' => 100,
				'timeOfSample' => '2017-01-01T00:00:00+01:00',
				'uncertaintyInMilliseconds' => 0
			]]
		];

		$this->assertEquals($expect, $context->render());
	}
}
