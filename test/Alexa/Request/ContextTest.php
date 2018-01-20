<?php

namespace Tests\Alexa\Request;

use \InternetOfVoice\LibVoice\Alexa\Request\Context;
use \PHPUnit\Framework\TestCase;

/**
 * Class ContextTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ContextTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testContext() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'), true);

		// Complement missing fixture data
		$fixture['context']['Display'] = [
			'templateVersion' => '1',
			'markupVersion' => '2',
			'token' => 'TOKEN',
		];

		$context = new Context($fixture['context']);
        $this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\Context\AudioPlayer', get_class($context->getAudioPlayer()));
        $this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\Context\Display', get_class($context->getDisplay()));
        $this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\Context\System', get_class($context->getSystem()));
	}
}
