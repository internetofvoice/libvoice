<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech;

/**
 * Abstract Class AbstractOutputSpeech
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
abstract class AbstractOutputSpeech {
	const MAX_CONTENT_CHARS = 8000;

	/** @var string $type */
	protected $type;

	/** @var string $type */
	protected $playBehavior;


	public function __construct() {
	}


	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getPlayBehavior() {
		return $this->playBehavior;
	}

	/**
	 * @param string $playBehavior
	 */
	public function setPlayBehavior($playBehavior) {
		if(in_array($playBehavior, ['ENQUEUE', 'REPLACE_ALL', 'REPLACE_ENQUEUED'])) {
			$this->playBehavior = $playBehavior;
		}
	}

	/**
	 * @return array
	 */
	abstract function render();
}
