<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Context;

/**
 * Class AudioPlayer
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
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
	public function __construct(array $audioPlayerData) {
		if (isset($audioPlayerData['token'])) {
			$this->token = $audioPlayerData['token'];
		}

		if (isset($audioPlayerData['offsetInMilliseconds'])) {
			$this->offsetInMilliseconds = intval($audioPlayerData['offsetInMilliseconds']);
		}

		if (isset($audioPlayerData['playerActivity'])) {
			$this->playerActivity = $audioPlayerData['playerActivity'];
		}
	}

	/**
	 * @return string
	 */
	public function getToken(): string {
		return $this->token;
	}

	/**
	 * @return int
	 */
	public function getOffsetInMilliseconds(): int {
		return $this->offsetInMilliseconds;
	}

	/**
	 * @return string
	 */
	public function getPlayerActivity(): string {
		return $this->playerActivity;
	}
}
