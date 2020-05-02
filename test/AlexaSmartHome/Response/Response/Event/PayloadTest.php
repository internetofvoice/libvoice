<?php

namespace Tests\AlexaSmartHome\Response\Response\Event;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Endpoint;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\Color;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\Temperature;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event\Payload;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class PayloadTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class PayloadTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testPayload() {
		$payload = new Payload();
		$payload->setEndpoints([new Endpoint([])]);
		$payload->setType('type');
		$payload->setMessage('message');

		$expect = [
			'endpoints' => [['endpointId' => null]],
			'type'      => 'type',
			'message'   => 'message',
		];

		$this->assertEquals($expect, $payload->render());
	}

	/**
	 * @group smarthome
	 */
	public function testPayloadConstruct() {
		$endpoint = new Endpoint();
		$payload  = new Payload(['endpoints' => [$endpoint], 'type' => 'type', 'message' => 'message', 'values' => ['value' => 1]]);

		$expect = [
			'endpoints' => [['endpointId' => null]],
			'type'      => 'type',
			'message'   => 'message',
			'value'     => 1,
		];

		$this->assertEquals($expect, $payload->render());
	}

	/**
	 * @group smarthome
	 */
	public function testMaxEndpoints() {
		$payload = new Payload();
		for($i = 0; $i < 300; $i++) {
			$payload->addEndpoint(new Endpoint());
		}

		$this->expectException(InvalidArgumentException::class);
		$payload->addEndpoint(new Endpoint());
	}

	/**
	 * @group smarthome
	 */
	public function testValues() {
		$payload = new Payload();
		$payload->setValues(['brightness' => 50]);
		$payload->addValue('array', [1, 2, 3]);
		$payload->addValue('temperature', new Temperature(20, 'CELSIUS'));
		$payload->addValue('colors', [new Color(0, 0, 0), new Color(1.0, 1.0, 1.0)]);

		$expect = [
			'brightness'  => 50,
			'array'       => [1, 2, 3],
			'temperature' => [
				'value'     => 20,
				'scale'     => 'CELSIUS'
			],
			'colors'      => [
				[
					'hue'        => 0.0,
					'saturation' => 0.0,
					'brightness' => 0.0,
				], [
					'hue'        => 1.0,
					'saturation' => 1.0,
					'brightness' => 1.0,
				]
			]
		];

		$this->assertEquals($expect, $payload->render());
	}
}
