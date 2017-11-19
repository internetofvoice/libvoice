<?php

namespace Tests\AlexaSmartHome\Response\Response\Event;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Endpoint;
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
			'type' => 'type',
			'message' => 'message',
		];

		$this->assertEquals($expect, $payload->render());
	}

	/**
	 * @group smarthome
	 */
	public function testPayloadConstruct() {
		$endpoint = new Endpoint();
		$payload  = new Payload(['endpoints' => [$endpoint], 'type' => 'type', 'message' => 'message']);

		$expect = [
			'endpoints' => [['endpointId' => null]],
			'type' => 'type',
			'message' => 'message',
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
}
