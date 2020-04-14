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
	public function __construct(string $source, Metadata $metadata = null) {
		$this->setSource($source);

		if($metadata) {
			$this->setMetadata($metadata);
		}
	}


	/**
	 * @return string
	 */
	public function getSource(): string {
		return $this->source;
	}

	/**
	 * @param string $source
	 *
	 * @return VideoItem
	 */
	public function setSource(string $source): VideoItem {
		$this->source = $source;

		return $this;
	}

	/**
	 * @return null|Metadata
	 */
	public function getMetadata(): ?Metadata {
		return $this->metadata;
	}

	/**
	 * @param  Metadata $metadata
	 *
	 * @return VideoItem
	 */
	public function setMetadata(Metadata $metadata): VideoItem {
		$this->metadata = $metadata;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		$rendered = [
			'source' => $this->getSource(),
		];

		if($this->getMetadata()) {
			$rendered['metadata'] = $this->getMetadata()->render();
		}

		return $rendered;
	}
}
