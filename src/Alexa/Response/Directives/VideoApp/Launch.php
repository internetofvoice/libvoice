<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\VideoApp;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AbstractDirective;

/**
 * Class Launch
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Launch extends AbstractDirective {
	/** @var VideoItem $videoItem */
	protected $videoItem;


	public function __construct($videoItem) {
		parent::__construct();

		$this->type = 'VideoApp.Launch';
		$this->setVideoItem($videoItem);
	}


	/**
	 * @return VideoItem
	 */
	public function getVideoItem() {
		return $this->videoItem;
	}

	/**
	 * @param VideoItem $videoItem
	 *
	 * @return Launch
	 */
	public function setVideoItem($videoItem) {
		$this->videoItem = $videoItem;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		return [
			'type' => $this->getType(),
			'videoItem' => $this->getVideoItem()->render(),
		];
	}
}
