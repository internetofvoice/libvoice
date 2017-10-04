<?php

namespace Tests\Alexa\Request;

use InternetOfVoice\LibVoice\Alexa\Request\Context;
use PHPUnit\Framework\TestCase;


/**
 * Class ContextTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ContextTest extends TestCase {
	/**
	 * testContext
	 */
	public function testContext() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'), true);
		$context = new Context($fixture['context']);
        $this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\Context\AudioPlayer', get_class($context->getAudioPlayer()));
        $this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\Context\System', get_class($context->getSystem()));
	}
}
