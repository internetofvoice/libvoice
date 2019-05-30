<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\VideoApp;

/**
 * Class Metadata
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Metadata {
	/** @var string $title */
	protected $title;

	/** @var string $subtitle */
	protected $subtitle;


	/**
	 * @param string $title
	 * @param string $subtitle
	 */
	public function __construct($title = '', $subtitle = '') {
		$this->setTitle($title);
		$this->setSubtitle($subtitle);
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
	 * @return Metadata
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
	 * @return Metadata
	 */
	public function setSubtitle($subtitle) {
		$this->subtitle = $subtitle;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		$result = [];
		if($this->getTitle()) {
			$result['title'] = $this->getTitle();
		}

		if($this->getSubtitle()) {
			$result['subtitle'] = $this->getSubtitle();
		}

		return $result;
	}
}
