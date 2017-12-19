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

	/** @var string $title */
	protected $title;

	/** @var string $subtitle */
	protected $subtitle;


	/**
	 * @param string $source
	 * @param string $title
	 * @param string $subtitle
	 */
	public function __construct($source, $title = '', $subtitle = '') {
		$this->setSource($source);
		$this->setTitle($title);
		$this->setSubtitle($subtitle);
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
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $title
	 *
	 * @return VideoItem
	 */
	public function setTitle($title) {
		$this->title = $title;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSubtitle() {
		return $this->subtitle;
	}

	/**
	 * @param string $subtitle
	 *
	 * @return VideoItem
	 */
	public function setSubtitle($subtitle) {
		$this->subtitle = $subtitle;

		return $this;
	}



	/**
	 * @return array
	 */
	public function render() {
		$rendered = [
			'source' => $this->getSource(),
		];

		if($this->getTitle()) {
			$rendered['metadata']['title'] = $this->getTitle();
		}

		if($this->getSubtitle()) {
			$rendered['metadata']['subtitle'] = $this->getSubtitle();
		}

		return $rendered;
	}
}
