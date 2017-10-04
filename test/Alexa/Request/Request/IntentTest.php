<?php

namespace Tests\Alexa\Request\Request;

use InternetOfVoice\LibVoice\Alexa\Request\Request\IntentRequest;
use \PHPUnit\Framework\TestCase;


/**
 * Class IntentTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
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
