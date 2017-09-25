<?php

namespace Tests\AlexaRequest\Context;

use InternetOfVoice\LibVoice\AlexaRequest\Context\System;
use \PHPUnit\Framework\TestCase;


class SystemTest extends TestCase {
	/**
	 * testSystem
	 */
	public function testSystem() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest-Body.txt'), true);
		$system = new System($fixture['context']['System']);
        $this->assertEquals('InternetOfVoice\LibVoice\AlexaRequest\Application', get_class($system->getApplication()));
        $this->assertEquals('InternetOfVoice\LibVoice\AlexaRequest\User', get_class($system->getUser()));
        $this->assertEquals('InternetOfVoice\LibVoice\AlexaRequest\Context\System\Device', get_class($system->getDevice()));
        $this->assertEquals('https://api.eu.amazonalexa.com', $system->getApiEndpoint());
	}
}
