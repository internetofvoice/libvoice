<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech;

/**
 * Abstract Class AbstractOutputSpeech
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
abstract class AbstractOutputSpeech {
	/** @var int MAX_CONTENT_CHARS */
	const MAX_CONTENT_CHARS = 8000;

	/** @var string $type */
	protected $type;

	/** @var string $type */
	protected $playBehavior;

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
	 * @return null|string
	 */
	public function getPlayBehavior(): ?string {
		return $this->playBehavior;
	}

	/**
	 * @param string $playBehavior
	 *
	 * @return AbstractOutputSpeech
	 */
	public function setPlayBehavior(string $playBehavior): AbstractOutputSpeech {
		if(in_array($playBehavior, ['ENQUEUE', 'REPLACE_ALL', 'REPLACE_ENQUEUED'])) {
			$this->playBehavior = $playBehavior;
		}

		return $this;
	}

	/**
	 * @return array
	 */
	abstract function render(): array ;
}
