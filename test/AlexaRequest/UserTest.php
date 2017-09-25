<?php

namespace Tests\AlexaRequest;

use InternetOfVoice\LibVoice\AlexaRequest\User;
use PHPUnit\Framework\TestCase;


class UserTest extends TestCase {
	/**
	 * testUser
	 */
	public function testUser() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'), true);
		$user = new User($fixture['session']['user']);
		$this->assertStringStartsWith('amzn1.ask.account.', $user->getUserId());
		$this->assertEquals('lo6539ti9xbd54ng', $user->getAccessToken());
	}
}
