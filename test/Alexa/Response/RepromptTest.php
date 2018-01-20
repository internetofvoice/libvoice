<?php

namespace Tests\Alexa\Response;

use \InternetOfVoice\LibVoice\Alexa\Response\Reprompt;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class RepromptTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class RepromptTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testReprompt() {
		$reprompt = new Reprompt('PlainText', 'Text');
		$this->assertEquals('InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\PlainText', get_class($reprompt->getOutputSpeech()));
		$this->assertEquals('{"outputSpeech":{"type":"PlainText","text":"Text"}}', json_encode($reprompt->render()));

		$reprompt = new Reprompt('SSML', 'SSML');
		$this->assertEquals('InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\SSML', get_class($reprompt->getOutputSpeech()));
		$this->assertEquals('{"outputSpeech":{"type":"SSML","ssml":"SSML"}}', json_encode($reprompt->render()));

		$this->expectException(InvalidArgumentException::class);
		new Reprompt('INVALID_TYPE', 'Text');
	}
}
