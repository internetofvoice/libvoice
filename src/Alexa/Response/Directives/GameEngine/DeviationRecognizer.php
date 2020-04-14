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
	public function __construct(string $id, string $recognizer) {
		parent::__construct($id);

		$this->type = 'deviation';
		$this->setRecognizer($recognizer);
	}


	/**
	 * @return string
	 */
	public function getRecognizer(): string {
		return $this->recognizer;
	}

	/**
	 * @param  string $recognizer
	 *
	 * @return DeviationRecognizer
	 */
	public function setRecognizer(string $recognizer): DeviationRecognizer {
		$this->recognizer = $recognizer;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'type'       => $this->getType(),
			'recognizer' => $this->getRecognizer(),
		];
	}
}
