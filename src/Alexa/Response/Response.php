<?php

namespace InternetOfVoice\LibVoice\Alexa\Response;

use InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\AbstractOutputSpeech;
use InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\PlainText;
use InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\SSML;

class Response {
	/** @var  AbstractOutputSpeech $outputSpeech */
	protected $outputSpeech;


	protected $card;

	/** @var  Reprompt $repromptSpeech */
	protected $repromptSpeech;

	// @TODO
	protected $directives;

	/** @var  bool $shouldEndSession */
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
	 * @param string $text
	 *
	 * @return Response
	 */
	public function reprompt($text) {
		$this->repromptSpeech = new Reprompt('PlainText', $text);

		return $this;
	}

	/**
	 * @param string $ssml
	 *
	 * @return Response
	 */
	public function repromptSSML($ssml) {
		$this->repromptSpeech = new Reprompt('SSML', $ssml);

		return $this;
	}


	/**
	 * @return AbstractOutputSpeech
	 */
	public function getOutputSpeech() {
		return $this->outputSpeech;
	}

	/**
	 * @return Reprompt
	 */
	public function getReprompt() {
		return $this->repromptSpeech;
	}

	/**
	 * @return bool
	 */
	public function isShouldEndSession() {
		return $this->shouldEndSession;
	}

	/**
	 * @param bool $shouldEndSession
	 *
	 * @return Response
	 */
	public function setShouldEndSession($shouldEndSession) {
		$this->shouldEndSession = boolval($shouldEndSession);

		return $this;
	}
}
