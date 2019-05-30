<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\VideoApp;

/**
 * Class VideoItem
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class VideoItem {
	/** @var string $source */
	protected $source;

	/** @var Metadata $metadata */
	protected $metadata;


	/**
	 * @param string   $source
	 * @param Metadata $metadata
	 */
	public function __construct($source, $metadata = null) {
		$this->setSource($source);

		if($metadata) {
			$this->setMetadata($metadata);
		}
	}


	/**
	 * @return string
	 */
	public function getSource() {
		return $this->source;
	}

	/**
	 * @param string $source
	 *
	 * @return VideoItem
	 */
	public function setSource($source) {
		$this->source = $source;

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
	 * @return VideoItem
	 */
	public function setMetadata($metadata) {
		$this->metadata = $metadata;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		$rendered = [
			'source' => $this->getSource(),
		];

		if($this->getMetadata()) {
			$rendered['metadata'] = $this->getMetadata()->render();
		}

		return $rendered;
	}
}
