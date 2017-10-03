<?php

namespace InternetOfVoice\LibVoice\Alexa\Response;

use InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\AbstractOutputSpeech;
use InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\PlainText;
use InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\SSML;

/**
 * Class Reprompt
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Reprompt {
	/** @var  AbstractOutputSpeech $outputSpeech */
	protected $outputSpeech;


	/**
	 * @param string $type
	 * @param string $text
	 */
	public function __construct($type, $text) {
		switch ($type) {
			case 'SSML':
				$this->outputSpeech = new SSML($text);
			break;

			case 'PlainText':
			default:
				$this->outputSpeech = new PlainText($text);
			break;
		}
	}


	/**
	 * @return AbstractOutputSpeech
	 */
	public function getOutputSpeech() {
		return $this->outputSpeech;
	}

	/**
	 * @return array
	 */
	function render() {
		return [
			'outputSpeech' => $this->outputSpeech->render(),
		];
	}
}
