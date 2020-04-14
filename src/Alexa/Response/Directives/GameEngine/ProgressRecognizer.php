<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\GameEngine;

use \InvalidArgumentException;

/**
 * Class ProgressRecognizer
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ProgressRecognizer extends AbstractRecognizer {
	/** @var string $recognizer */
	protected $recognizer;

	/** @var int $completion (percentage) */
	protected $completion = 100;


	/**
	 * @param string $id
	 * @param string $recognizer
	 * @param int    $completion
	 */
	public function __construct(string $id, string $recognizer, int $completion = 100) {
		parent::__construct($id);

		$this->type = 'progress';
		$this->setRecognizer($recognizer);
		$this->setCompletion($completion);
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
	 * @return ProgressRecognizer
	 */
	public function setRecognizer(string $recognizer): ProgressRecognizer {
		$this->recognizer = $recognizer;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getCompletion(): int {
		return $this->completion;
	}

	/**
	 * @param  int $completion (percentage)
	 *
	 * @return ProgressRecognizer
	 * @throws InvalidArgumentException
	 */
	public function setCompletion(int $completion): ProgressRecognizer {
		if(!is_int($completion) || $completion < 0 || $completion > 100) {
			throw new InvalidArgumentException('Completion must be an integer between 0 and 100.');
		}

		$this->completion = $completion;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'type'       => $this->getType(),
			'recognizer' => $this->getRecognizer(),
			'completion' => $this->getCompletion(),
		];
	}
}
