<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\AudioPlayer;

use \InternetOfVoice\LibVoice\Alexa\Request\Request\AbstractRequest;

/**
 * Class PlaybackStarted
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class PlaybackStarted extends AbstractRequest {
	/** @var string $token */
	protected $token;

	/** @var int $offsetInMilliseconds */
	protected $offsetInMilliseconds;


	/**
	 * @param array $requestData
	 */
	public function __construct($requestData) {
		parent::__construct($requestData);

		if(isset($requestData['token'])) {
			$this->token = $requestData['token'];
		}

		if(isset($requestData['offsetInMilliseconds'])) {
			$this->offsetInMilliseconds = intval($requestData['offsetInMilliseconds']);
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
}
