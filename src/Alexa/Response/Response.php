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
	public function setOutputSpeech(AbstractOutputSpeech $outputSpeech): Response {
		$this->outputSpeech = $outputSpeech;

		return $this;
	}

	/**
	 * @return null|AbstractOutputSpeech
	 */
	public function getOutputSpeech(): ?AbstractOutputSpeech {
		return $this->outputSpeech;
	}

	/**
	 * @param AbstractCard $card
	 *
	 * @return Response
	 */
	public function setCard(AbstractCard $card): Response {
		$this->card = $card;

		return $this;
	}

	/**
	 * @return null|AbstractCard
	 */
	public function getCard(): ?AbstractCard {
		return $this->card;
	}

	/**
	 * @param Reprompt $reprompt
	 *
	 * @return Response
	 */
	public function setReprompt(Reprompt $reprompt): Response {
		$this->reprompt = $reprompt;

		return $this;
	}

	/**
	 * @return null|Reprompt
	 */
	public function getReprompt(): ?Reprompt {
		return $this->reprompt;
	}

	/**
	 * @return AbstractDirective[]
	 */
	public function getDirectives(): array {
		return $this->directives;
	}

	/**
	 * @param AbstractDirective[] $directives
	 *
	 * @return Response
	 */
	public function setDirectives(array $directives): Response {
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
	public function addDirective(AbstractDirective $directive): Response {
		array_push($this->directives, $directive);

		return $this;
	}

	/**
	 * @return null|bool
	 */
	public function getShouldEndSession(): ?bool {
		return $this->shouldEndSession;
	}

	/**
	 * @param bool $shouldEndSession
	 *
	 * @return Response
	 */
	public function setShouldEndSession(bool $shouldEndSession): Response {
		$this->shouldEndSession = $shouldEndSession;

		return $this;
	}

	/**
	 * @return null|CanFulfillIntent
	 */
	public function getCanFulfillIntent(): ?CanFulfillIntent {
		return $this->canFulfillIntent;
	}

	/**
	 * @param  CanFulfillIntent $canFulfillIntent
	 *
	 * @return Response
	 */
	public function setCanFulfillIntent(CanFulfillIntent $canFulfillIntent): Response {
		$this->canFulfillIntent = $canFulfillIntent;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
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

		if(!is_null($this->getShouldEndSession())) {
			$rendered['shouldEndSession'] = $this->getShouldEndSession();
		}

		return $rendered;
	}
}
