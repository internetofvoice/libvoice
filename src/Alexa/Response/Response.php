<?php

namespace InternetOfVoice\LibVoice\Alexa\Response;

use InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\OutputSpeech;
use InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\PlainText;
use InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\SSML;

class Response {
	/** @var  OutputSpeech $outputSpeech */
	protected $outputSpeech;

	protected $card;
	protected $reprompt;
	protected $directives;
	protected $shouldEndSession;


	/**
	 * @param string $text
	 *
	 * @return Response
	 */
	public function respond($text) {
		$this->outputSpeech = new PlainText($text);

		return $this;
	}

	/**
	 * @param string $ssml
	 *
	 * @return Response
	 */
	public function respondSSML($ssml) {
		$this->outputSpeech = new SSML($ssml);

		return $this;
	}

	/**
	 * @return OutputSpeech
	 */
	public function getOutputSpeech() {
		return $this->outputSpeech;
	}
}
