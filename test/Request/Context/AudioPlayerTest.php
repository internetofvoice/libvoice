<?php

namespace Tests\Request;

use \Alexa\Request\Context\AudioPlayer;
use \PHPUnit\Framework\TestCase;


class AudioPlayerTest extends TestCase {
	/**
	 * testAudioPlayer
	 */
	public function testAudioPlayer() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/IntentRequest-Body.txt'), true);
		$audioPlayer = new AudioPlayer($fixture['context']['AudioPlayer']);
		$this->assertEquals('IDLE', $audioPlayer->getPlayerActivity());
        $this->assertEquals(null, $audioPlayer->getOffsetInMilliseconds());
        $this->assertEquals(null, $audioPlayer->getToken());
	}
}
