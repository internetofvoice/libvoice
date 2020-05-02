<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\AudioPlayer;

use \InternetOfVoice\LibVoice\Alexa\Request\Error;
use \InternetOfVoice\LibVoice\Alexa\Request\Context\AudioPlayer;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\AbstractRequest;

/**
 * Class PlaybackFailed
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class PlaybackFailed extends AbstractRequest {
	/** @var string $token */
	protected $token;

	/** @var Error $error */
	protected $error;

	/** @var AudioPlayer $currentPlaybackState */
	protected $currentPlaybackState;


	/**
	 * @param array $requestData
	 */
	public function __construct(array $requestData) {
		parent::__construct($requestData);

		if(isset($requestData['token'])) {
			$this->token = $requestData['token'];
		}

		if(isset($requestData['error'])) {
			$this->error = new Error($requestData['error']);
		}

		if(isset($requestData['currentPlaybackState'])) {
			$this->currentPlaybackState = new AudioPlayer($requestData['currentPlaybackState']);
		}
	}


	/**
	 * @return string
	 */
	public function getToken(): string {
		return $this->token;
	}

	/**
	 * @return Error
	 */
	public function getError(): Error {
		return $this->error;
	}

	/**
	 * @return AudioPlayer
	 */
	public function getCurrentPlaybackState(): AudioPlayer {
		return $this->currentPlaybackState;
	}
}
