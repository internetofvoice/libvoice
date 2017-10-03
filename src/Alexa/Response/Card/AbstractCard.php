<?php

namespace Alexa\Alexa\Response\Card;

/**
 * Abstract Class AbstractCard
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
abstract class AbstractCard {
	const MAX_TITLE_CHARS = 64;
	const MAX_CONTENT_CHARS = 6000;

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
