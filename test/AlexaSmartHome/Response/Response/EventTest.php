<?php

namespace Tests\AlexaSmartHome\Response\Response;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Endpoint;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event\Header;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event\Payload;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class EventTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class EventTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testEvent() {
		$event = new Event(new Header(), new Payload(), new Endpoint());
		$expect = [
			'header' => [
				'namespace' => 'Alexa',
				'name' => null,
				'payloadVersion' => 3,
				'messageId' => null,
			],
			'payload' => [],
			'endpoint' => [
				'endpointId' => null
			],
		];

		$this->assertEquals($expect, $event->render());
	}

	/**
	 * @group smarthome
	 */
	public function testMissingHeader() {
		$event = new Event();
		$this->expectException(InvalidArgumentException::class);
		$event->render();
	}

	/**
	 * @group smarthome
	 */
	public function testMissingPayload() {
		$event = new Event(new Header());
		$this->expectException(InvalidArgumentException::class);
		$event->render();
	}
}
