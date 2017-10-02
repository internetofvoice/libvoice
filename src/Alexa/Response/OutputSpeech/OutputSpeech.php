<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech;


abstract class OutputSpeech {
	/** @var string $type */
	protected $type;


	public function __construct() {
	}


	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @return array
	 */
	abstract function render();
}
