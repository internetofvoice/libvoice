<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech;

/**
 * Abstract Class AbstractOutputSpeech
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
abstract class AbstractOutputSpeech {
	const MAX_CONTENT_CHARS = 6000;

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
