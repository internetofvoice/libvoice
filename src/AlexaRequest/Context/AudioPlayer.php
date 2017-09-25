<?php

namespace InternetOfVoice\LibVoice\AlexaRequest\Context;

class AudioPlayer {
    /** @var string $token */
    protected $token;

    /** @var int $offsetInMilliseconds */
    protected $offsetInMilliseconds;

    /** @var string $playerActivity */
    protected $playerActivity;


    /**
     * @param array $audioPlayerData
     */
    public function __construct($audioPlayerData) {
        if(isset($audioPlayerData['token'])) {
            $this->token = $audioPlayerData['token'];
        }

        if(isset($audioPlayerData['offsetInMilliseconds'])) {
            $this->offsetInMilliseconds = intval($audioPlayerData['offsetInMilliseconds']);
        }

        if(isset($audioPlayerData['playerActivity'])) {
            $this->playerActivity = $audioPlayerData['playerActivity'];
        }
    }

    /**
     * @return string
     */
    public function getToken() {
        return $this->token;
    }

    /**
     * @return int
     */
    public function getOffsetInMilliseconds() {
        return $this->offsetInMilliseconds;
    }

    /**
     * @return string
     */
    public function getPlayerActivity() {
        return $this->playerActivity;
    }
}
