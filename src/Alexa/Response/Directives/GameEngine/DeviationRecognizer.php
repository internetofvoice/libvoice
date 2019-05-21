<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\GameEngine;

/**
 * Class DeviationRecognizer
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class DeviationRecognizer extends AbstractRecognizer {
	/** @var string $recognizer */
	protected $recognizer;


	/**
	 * @param string $id
	 * @param string $recognizer
	 */
	public function __construct($id, $recognizer) {
		parent::__construct($id);

		$this->type = 'deviation';
		$this->setRecognizer($recognizer);
	}


	/**
	 * @return string
	 */
	public function getRecognizer() {
		return $this->recognizer;
	}

	/**
	 * @param  string $recognizer
	 *
	 * @return DeviationRecognizer
	 */
	public function setRecognizer($recognizer) {
		$this->recognizer = $recognizer;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		$rendered = [
			'type'       => $this->getType(),
			'recognizer' => $this->getRecognizer(),
		];

		return $rendered;
	}
}
