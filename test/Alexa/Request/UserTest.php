<?php

namespace Tests\Alexa\Request;

use \InternetOfVoice\LibVoice\Alexa\Request\User;
use \PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class UserTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testUser() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'), true);

		// Complement missing fixture data
		$fixture['session']['user']['permissions'] = ['consentToken' => '123'];

		$user = new User($fixture['session']['user']);
		$this->assertStringStartsWith('amzn1.ask.account.', $user->getUserId());
		$this->assertEquals('lo6539ti9xbd54ng', $user->getAccessToken());
		$this->assertEquals('123', $user->getPermissions()->getConsentToken());
	}
}
