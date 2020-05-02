<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives;

/**
 * Abstract Class AbstractDirective
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
abstract class AbstractDirective {
	/** @var string $type */
	protected $type;

	/**
	 */
	public function __construct() {
	}


	/**
	 * @return string
	 */
	public function getType(): string {
		return $this->type;
	}

	/**
	 * @return array
	 */
	abstract function render(): array;
}
