<?php

namespace Tests\Alexa\Request\Context;

use \InternetOfVoice\LibVoice\Alexa\Request\Context\AudioPlayer;
use \PHPUnit\Framework\TestCase;

/**
 * Class AudioPlayerTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class AudioPlayerTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testAudioPlayer() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest-Body.txt'), true);

		// Complement missing fixture data
		$fixture['context']['AudioPlayer']['token'] = 'token';
		$fixture['context']['AudioPlayer']['offsetInMilliseconds'] = 100;

		$audioPlayer = new AudioPlayer($fixture['context']['AudioPlayer']);
		$this->assertEquals('IDLE', $audioPlayer->getPlayerActivity());
        $this->assertEquals(100, $audioPlayer->getOffsetInMilliseconds());
        $this->assertEquals('token', $audioPlayer->getToken());
	}
}
