<?php

namespace Tests\Request;

use \Alexa\Request\Session;
use \PHPUnit\Framework\TestCase;


class SessionTest extends TestCase {
	/**
	 * testSession
	 */
	public function testSession() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest-Body.txt'), true);
		$session = new Session($fixture['session']);
		$this->assertStringStartsWith('amzn1.echo-api.session.', $session->getSessionId());
		$this->assertTrue($session->isNew());
		$this->assertEquals('Alexa\Request\User', get_class($session->getUser()));
		$this->assertEquals('Alexa\Request\Application', get_class($session->getApplication()));
	}
}
