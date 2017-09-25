<?php

namespace InternetOfVoice\LibVoice\AlexaRequest;

use InternetOfVoice\LibVoice\AlexaRequest\Context\AudioPlayer;
use InternetOfVoice\LibVoice\AlexaRequest\Context\System;

class Context {
    /** @var AudioPlayer $audioPlayer */
    protected $audioPlayer;

    /** @var System $system */
    protected $system;


	/**
	 * @param array $contextData
	 */
	public function __construct($contextData) {
        if(isset($contextData['AudioPlayer'])) {
            $this->audioPlayer = new AudioPlayer($contextData['AudioPlayer']);
        }

        if(isset($contextData['System'])) {
            $this->system = new System($contextData['System']);
        }
	}


    /**
     * @return AudioPlayer
     */
    public function getAudioPlayer() {
        return $this->audioPlayer;
    }

    /**
     * @return System
     */
    public function getSystem() {
        return $this->system;
    }
}

