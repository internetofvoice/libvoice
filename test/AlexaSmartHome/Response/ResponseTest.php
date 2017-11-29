<?php

namespace Tests\AlexaSmartHome\Response;

use \DateTime;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Endpoint;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\ReportableProperty;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event\Header;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event\Payload;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Context;
use \PHPUnit\Framework\TestCase;

/**
 * Class ResponseTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ResponseTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testResponse() {
		$time     = new DateTime('2017-01-01 00:00:00');
		$property = new ReportableProperty('Alexa.BrightnessController', 'brightness', 100, $time);
		$context  = new Context([$property]);
		$event    = new Event(new Header(), new Payload(), new Endpoint());
		$response = new Response($event, $context);

		$expect = [
			'event'   => [
				'header'   => [
					'namespace'      => 'Alexa',
					'name'           => null,
					'payloadVersion' => 3,
					'messageId'      => null,
				],
				'payload'  => [],
				'endpoint' => [
					'endpointId' => null,
				],
			],
			'context' => [
				'properties' => [
					[
						'namespace'                 => 'Alexa.BrightnessController',
						'name'                      => 'brightness',
						'value'                     => 100,
						'timeOfSample'              => '2017-01-01T00:00:00+01:00',
						'uncertaintyInMilliseconds' => 0,
					],
				],
			],
		];

		$this->assertEquals($expect, $response->render());
	}
}
