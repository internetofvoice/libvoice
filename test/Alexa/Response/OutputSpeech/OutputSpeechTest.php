<?php

namespace Tests\Alexa\Response\OutputSpeech;

use InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\PlainText;
use InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\SSML;
use PHPUnit\Framework\TestCase;

/**
 * Class OutputSpeechTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class OutputSpeechTest extends TestCase {
	/**
	 * testPlainText
	 */
	public function testPlainText() {
		$speech = new PlainText('Text');
		$this->assertEquals('PlainText', $speech->getType());
		$this->assertEquals('Text', $speech->getText());
		$this->assertTrue(is_array($speech->render()));
		$this->assertEquals('{"type":"PlainText","text":"Text"}', json_encode($speech->render()));

		$speech->setText(str_repeat('x', 10000));
		$this->assertEquals(8000, strlen($speech->getText()));
	}

	/**
	 * testSSML
	 */
	public function testSSML() {
		$speech = new SSML('Text');
		$this->assertEquals('SSML', $speech->getType());
		$this->assertEquals('Text', $speech->getSSML());
		$this->assertTrue(is_array($speech->render()));
		$this->assertEquals('{"type":"SSML","ssml":"Text"}', json_encode($speech->render()));

		$speech->setSSML(str_repeat('x', 10000));
		$this->assertEquals(8000, strlen($speech->getSSML()));
	}
}
