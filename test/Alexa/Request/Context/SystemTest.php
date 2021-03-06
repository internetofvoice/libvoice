<?php

namespace Tests\Alexa\Request\Context;

use \InternetOfVoice\LibVoice\Alexa\Request\Context\System;
use \PHPUnit\Framework\TestCase;

/**
 * Class SystemTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class SystemTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testSystem() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest-Body.txt'), true);
		$fixture['context']['System']['apiAccessToken'] = 'apiAccessToken';
		$system = new System($fixture['context']['System']);
        $this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\Application', get_class($system->getApplication()));
        $this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\User', get_class($system->getUser()));
        $this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\Context\System\Device', get_class($system->getDevice()));
        $this->assertEquals('https://api.eu.amazonalexa.com', $system->getApiEndpoint());
        $this->assertEquals('apiAccessToken', $system->getApiAccessToken());
	}

	/**
	 * @group custom-skill
	 */
	public function testSupport() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/System.json'), true);
		$system = new System($fixture);
		$this->assertEquals(true, $system->supportsAlexaCameraPhotoCaptureController());
		$this->assertEquals(true, $system->supportsAlexaCameraVideoCaptureController());
		$this->assertEquals(true, $system->supportsAlexaPresentationAPL());
		$this->assertEquals(true, $system->supportsAudioPlayer());
		$this->assertEquals(true, $system->supportsDisplay());
		$this->assertEquals(true, $system->supportsGeolocation());
		$this->assertEquals(true, $system->supportsVideoApp());
	}
}
