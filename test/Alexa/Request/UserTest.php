<?php

namespace Tests\Alexa\Request;

use InternetOfVoice\LibVoice\Alexa\Request\User;
use PHPUnit\Framework\TestCase;


/**
 * Class UserTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class UserTest extends TestCase {
	/**
	 * testUser
	 */
	public function testUser() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'), true);

		// Complement missing fixture data
		$fixture['session']['user']['permissions'] = ['permission1' => 1, 'permission2' => 2];

		$user = new User($fixture['session']['user']);
		$this->assertStringStartsWith('amzn1.ask.account.', $user->getUserId());
		$this->assertEquals('lo6539ti9xbd54ng', $user->getAccessToken());
		$this->assertEquals(2, count($user->getPermissions()));
	}
}
