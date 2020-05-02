<?php

namespace InternetOfVoice\LibVoice\Alexa\Response;

use \InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\AbstractOutputSpeech;
use \InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\PlainText;
use \InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\SSML;
use \InvalidArgumentException;

/**
 * Class Reprompt
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Reprompt {
	/** @var AbstractOutputSpeech $outputSpeech */
	protected $outputSpeech;


	/**
	 * @param string $type
	 * @param string $text
	 *
	 * @throws InvalidArgumentException
	 */
	public function __construct(string $type, string $text) {
		switch ($type) {
			case 'SSML':
				$this->outputSpeech = new SSML($text);
			break;

			case 'PlainText':
				$this->outputSpeech = new PlainText($text);
			break;

			default:
				throw new InvalidArgumentException('Reprompt type must be PlainText or SSML.');
			break;
		}
	}


	/**
	 * @return AbstractOutputSpeech
	 */
	public function getOutputSpeech(): AbstractOutputSpeech {
		return $this->outputSpeech;
	}

	/**
	 * @return array
	 */
	function render():array {
		return [
			'outputSpeech' => $this->getOutputSpeech()->render(),
		];
	}
}
