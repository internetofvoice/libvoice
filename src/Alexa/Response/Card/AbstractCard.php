<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Card;

/**
 * Abstract Class AbstractCard
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
abstract class AbstractCard {
	const MAX_CONTENT_CHARS = 8000;
	const MAX_URL_CHARS     = 2000;


	/** @var  string $type */
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
