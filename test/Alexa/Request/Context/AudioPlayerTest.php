<?php

namespace Tests\Alexa\Request\Context;

use InternetOfVoice\LibVoice\Alexa\Request\Context\AudioPlayer;
use \PHPUnit\Framework\TestCase;


class AudioPlayerTest extends TestCase {
	/**
	 * testAudioPlayer
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
