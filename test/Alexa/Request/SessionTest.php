<?php

namespace Tests\Alexa\Request;

use InternetOfVoice\LibVoice\Alexa\Request\Session;
use PHPUnit\Framework\TestCase;


class SessionTest extends TestCase {
	/**
	 * testSession
	 */
	public function testSession() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'), true);

		// Complement missing fixture data
		$fixture['session']['attributes'] = ['attribute1' => 1, 'attribute2' => 2];

		$session = new Session($fixture['session']);
		$this->assertStringStartsWith('amzn1.echo-api.session.', $session->getSessionId());
		$this->assertTrue($session->isNew());
		$this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\User', get_class($session->getUser()));
		$this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\Application', get_class($session->getApplication()));
		$this->assertTrue(is_array($session->getAttributes()));
		$this->assertEquals(2, $session->getAttribute('attribute2'));
		$this->assertFalse($session->getAttribute('attribute3'));
	}
}
