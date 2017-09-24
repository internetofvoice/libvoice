<?php

namespace Tests\Request;

use \Alexa\Request\Context;
use \PHPUnit\Framework\TestCase;


class ContextTest extends TestCase {
	/**
	 * testContext
	 */
	public function testContext() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest-Body.txt'), true);
		$context = new Context($fixture['context']);
        $this->assertEquals('Alexa\Request\Context\AudioPlayer', get_class($context->getAudioPlayer()));
        $this->assertEquals('Alexa\Request\Context\System', get_class($context->getSystem()));
	}
}
