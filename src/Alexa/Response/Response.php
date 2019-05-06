<?php

namespace InternetOfVoice\LibVoice\Alexa\Response;

use \InternetOfVoice\LibVoice\Alexa\Response\CanFulFill\CanFulfillIntent;
use \InternetOfVoice\LibVoice\Alexa\Response\Card\AbstractCard;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AbstractDirective;
use \InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\AbstractOutputSpeech;

class Response {
	/** @var  AbstractOutputSpeech $outputSpeech */
	protected $outputSpeech;

	/** @var  AbstractCard $card */
	protected $card;

	/** @var  Reprompt $reprompt */
	protected $reprompt;

	/** @var  AbstractDirective[] $directives */
	protected $directives = [];

	/** @var  bool $shouldEndSession */
	protected $shouldEndSession;

	/** @var CanFulfillIntent $canFulfillIntent */
	protected $canFulfillIntent;


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
	 * @return AbstractDirective[]
	 */
	public function getDirectives() {
		return $this->directives;
	}

	/**
	 * @param AbstractDirective[] $directives
	 *
	 * @return Response
	 */
	public function setDirectives($directives) {
		foreach($directives as $directive) {
			$this->addDirective($directive);
		}

		return $this;
	}

	/**
	 * @param AbstractDirective $directive
	 *
	 * @return Response
	 */
	public function addDirective($directive) {
		array_push($this->directives, $directive);

		return $this;
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
	 * @return CanFulfillIntent
	 */
	public function getCanFulfillIntent() {
		return $this->canFulfillIntent;
	}

	/**
	 * @param  CanFulfillIntent $canFulfillIntent
	 *
	 * @return Response
	 */
	public function setCanFulfillIntent($canFulfillIntent) {
		$this->canFulfillIntent = $canFulfillIntent;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		$rendered = [];
		if($this->getOutputSpeech()) {
			$rendered['outputSpeech'] = $this->getOutputSpeech()->render();
		}

		if($this->getCard()) {
			$rendered['card'] = $this->getCard()->render();
		}

		if($this->getReprompt()) {
			$rendered['reprompt'] = $this->getReprompt()->render();
		}

		if(count($this->getDirectives())) {
			$renderedDirectives = array();
			foreach($this->getDirectives() as $directive) {
				array_push($renderedDirectives, $directive->render());
			}

			$rendered['directives'] = $renderedDirectives;
		}

		if($this->getCanFulfillIntent()) {
			$rendered['canFulfillIntent'] = $this->getCanFulfillIntent()->render();
		}

		$rendered['shouldEndSession'] = $this->getShouldEndSession();
		return $rendered;
	}
}
