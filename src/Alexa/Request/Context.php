<?php

namespace InternetOfVoice\LibVoice\Alexa\Request;

use \InternetOfVoice\LibVoice\Alexa\Request\Context\AudioPlayer;
use \InternetOfVoice\LibVoice\Alexa\Request\Context\Display;
use \InternetOfVoice\LibVoice\Alexa\Request\Context\System;
use \InternetOfVoice\LibVoice\Alexa\Request\Context\Viewport;

/**
 * Class Context
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Context {
	/** @var AudioPlayer $audioPlayer */
	protected $audioPlayer;

	/** @var Display $display */
	protected $display;

	/** @var System $system */
	protected $system;

	/** @var Viewport $viewport */
	protected $viewport;


	/**
	 * @param array $contextData
	 */
	public function __construct(array $contextData) {
		if(isset($contextData['AudioPlayer'])) {
			$this->audioPlayer = new AudioPlayer($contextData['AudioPlayer']);
		}

		if(isset($contextData['Display'])) {
			$this->display = new Display($contextData['Display']);
		}

		if(isset($contextData['System'])) {
			$this->system = new System($contextData['System']);
		}

		if(isset($contextData['Viewport'])) {
			$this->viewport = new Viewport($contextData['Viewport']);
		}
	}


	/**
	 * @return AudioPlayer
	 */
	public function getAudioPlayer(): AudioPlayer {
		return $this->audioPlayer;
	}

	/**
	 * @return Display
	 */
	public function getDisplay(): Display {
		return $this->display;
	}

	/**
	 * @return System
	 */
	public function getSystem(): System {
		return $this->system;
	}

	/**
	 * @return Viewport
	 */
	public function getViewport(): Viewport {
		return $this->viewport;
	}
}

