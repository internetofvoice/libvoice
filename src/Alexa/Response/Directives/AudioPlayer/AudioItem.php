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

	/** @var Metadata $metadata */
	protected $metadata;


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
	 * @return Metadata
	 */
	public function getMetadata() {
		return $this->metadata;
	}

	/**
	 * @param  Metadata $metadata
	 *
	 * @return AudioItem
	 */
	public function setMetadata($metadata) {
		$this->metadata = $metadata;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		$result = [
			'stream' => $this->getStream()->render(),
		];

		if($this->getMetadata()) {
			$result['metadata'] = $this->getMetadata()->render();
		}

		return $result;
	}
}
