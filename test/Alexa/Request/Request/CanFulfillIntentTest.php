<?php

namespace Tests\Alexa\Request\Request;

use \InternetOfVoice\LibVoice\Alexa\Request\Request\CanFulfillIntentRequest;
use \PHPUnit\Framework\TestCase;

/**
 * Class CanFulfillIntentTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class CanFulfillIntentTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testCanFulfillIntent() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/CanFulfillIntentRequest.json'), true);

		// Mock additional data
		$request = new CanFulfillIntentRequest($fixture['request']);

		// Request
		$this->assertEquals('CanFulfillIntentRequest', $request->getType());
		$this->assertStringStartsWith('amzn1.echo-api.request.', $request->getRequestId());
		$this->assertEquals('2019-05-05 17:23:48', $request->getTimestamp()->format('Y-m-d H:i:s'));
		$this->assertEquals('en-US', $request->getLocale());

		// Intent
		$intent = $request->getIntent();
		$this->assertEquals('PlaySound', $intent->getName());

		// Slots
		$slot = $intent->getSlot('Sound');
		$this->assertEquals('Sound', $slot->getName());
		$this->assertEquals('crickets', $slot->getValue());
	}
}
