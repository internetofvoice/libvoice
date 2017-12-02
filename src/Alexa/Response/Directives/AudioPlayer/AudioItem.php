<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\AudioPlayer;

/**
 * Class AudioItem
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class AudioItem {
	/** @var Stream $stream */
	protected $stream;


	/**
	 * @param Stream $stream
	 */
	public function __construct($stream) {
		$this->setStream($stream);
	}


	/**
	 * @return Stream
	 */
	public function getStream() {
		return $this->stream;
	}

	/**
	 * @param Stream $stream
	 *
	 * @return AudioItem
	 */
	public function setStream($stream) {
		$this->stream = $stream;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		return [
			'stream' => $this->getStream()->render(),
		];
	}
}
