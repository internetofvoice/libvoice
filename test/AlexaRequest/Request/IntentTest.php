<?php

namespace Tests\AlexaRequest\Request;

use InternetOfVoice\LibVoice\AlexaRequest\Request\IntentRequest;
use \PHPUnit\Framework\TestCase;


class IntentTest extends TestCase {
	/**
	 * testIntent
	 */
	public function testIntent() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest2-Body.txt'), true);
		$request = new IntentRequest($fixture['request']);

		// Request
		$this->assertEquals('IntentRequest', $request->getType());
		$this->assertStringStartsWith('amzn1.echo-api.request.', $request->getRequestId());
		$this->assertEquals('de-DE', $request->getLocale());

		// Intent
		$intent = $request->getIntent();
		$this->assertEquals('ValuesAtIntent', $intent->getName());
		$this->assertEquals('NONE', $intent->getConfirmationStatus());

		// Slots
		$slot = $intent->getSlot('day');
		$this->assertEquals('day', $slot->getName());
		$this->assertEquals('2017-09-17', $slot->getValue());

		$slot = $intent->getSlot('time');
		$this->assertEquals('time', $slot->getName());
		$this->assertNull($slot->getValue());
	}
}
