<?php

namespace Tests\AlexaRequest;

use InternetOfVoice\LibVoice\AlexaRequest\Context;
use PHPUnit\Framework\TestCase;


class ContextTest extends TestCase {
	/**
	 * testContext
	 */
	public function testContext() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'), true);
		$context = new Context($fixture['context']);
        $this->assertEquals('InternetOfVoice\LibVoice\AlexaRequest\Context\AudioPlayer', get_class($context->getAudioPlayer()));
        $this->assertEquals('InternetOfVoice\LibVoice\AlexaRequest\Context\System', get_class($context->getSystem()));
	}
}
