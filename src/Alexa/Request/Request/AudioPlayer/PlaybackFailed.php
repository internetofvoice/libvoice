<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\AudioPlayer;

use \InternetOfVoice\LibVoice\Alexa\Request\Context\AudioPlayer;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\AbstractRequest;
use \stdClass;

/**
 * Class PlaybackFailed
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class PlaybackFailed extends AbstractRequest {
	/** @var string $token */
	protected $token;

	/** @var stdClass $error */
	protected $error;

	/** @var AudioPlayer $currentPlaybackState */
	protected $currentPlaybackState;


	/**
	 * @param array $requestData
	 */
	public function __construct($requestData) {
		parent::__construct($requestData);

		if(isset($requestData['token'])) {
			$this->token = $requestData['token'];
		}

		if(isset($requestData['error'])) {
			$this->error = json_decode(json_encode($requestData['error']));
		}

		if(isset($requestData['currentPlaybackState'])) {
			$this->currentPlaybackState = new AudioPlayer($requestData['currentPlaybackState']);
		}
	}


	/**
	 * @return string
	 */
	public function getToken() {
		return $this->token;
	}

	/**
	 * @return stdClass
	 */
	public function getError() {
		return $this->error;
	}

	/**
	 * @return AudioPlayer
	 */
	public function getCurrentPlaybackState() {
		return $this->currentPlaybackState;
	}
}
