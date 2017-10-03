<?php

namespace InternetOfVoice\LibVoice\Alexa\Response;

use Alexa\Alexa\Response\Card\AbstractCard;
use InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\AbstractOutputSpeech;

class Response {
	/** @var  AbstractOutputSpeech $outputSpeech */
	protected $outputSpeech;

	/** @var  AbstractCard $card */
	protected $card;

	/** @var  Reprompt $reprompt */
	protected $reprompt;

	// @TODO
	// protected $directives;

	/** @var  bool $shouldEndSession */
	protected $shouldEndSession;


	/**
	 * @param AbstractOutputSpeech $outputSpeech
	 *
	 * @return Response
	 */
	public function setOutputSpeech($outputSpeech) {
		$this->outputSpeech = $outputSpeech;

		return $this;
	}

	/**
	 * @return AbstractOutputSpeech
	 */
	public function getOutputSpeech() {
		return $this->outputSpeech;
	}

	/**
	 * @param AbstractCard $card
	 *
	 * @return Response
	 */
	public function setCard($card) {
		$this->card = $card;

		return $this;
	}

	/**
	 * @return AbstractCard
	 */
	public function getCard() {
		return $this->card;
	}

	/**
	 * @param Reprompt $reprompt
	 *
	 * @return Response
	 */
	public function setReprompt($reprompt) {
		$this->reprompt = $reprompt;

		return $this;
	}

	/**
	 * @return Reprompt
	 */
	public function getReprompt() {
		return $this->reprompt;
	}

	/**
	 * @return bool
	 */
	public function getShouldEndSession() {
		return $this->shouldEndSession;
	}

	/**
	 * @param bool $shouldEndSession
	 *
	 * @return Response
	 */
	public function setShouldEndSession($shouldEndSession) {
		$this->shouldEndSession = $shouldEndSession;

		return $this;
	}

	/**
	 * @return array
	 */
	public function render() {
		$rendered = array();
		if (!is_null($this->outputSpeech)) {
			$rendered['outputSpeech'] = $this->outputSpeech->render();

		}

		if (!is_null($this->card)) {
			$rendered['card'] = $this->card->render();

		}

		if (!is_null($this->reprompt)) {
			$rendered['reprompt'] = $this->reprompt->render();

		}

		/*
		 * @TODO
		if(!is_null($this->directives)) {
			$rendered['directives'] = $this->directives->render();
		}
		*/

		$rendered['shouldEndSession'] = $this->shouldEndSession;

		return $rendered;
	}
}
