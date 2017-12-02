<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\AudioPlayer;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AbstractDirective;
use \InvalidArgumentException;

/**
 * Class Play
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Play extends AbstractDirective {
	/** @var array PLAY_BEHAVIORS */
	const PLAY_BEHAVIORS = ['REPLACE_ALL', 'ENQUEUE', 'REPLACE_ENQUEUED'];

	/** @var string $playBehavior */
	protected $playBehavior;

	/** @var AudioItem $audioItem */
	protected $audioItem;


	/**
	 * @param string    $playBehavior
	 * @param AudioItem $audioItem
	 */
	public function __construct($playBehavior, $audioItem) {
		parent::__construct();

		$this->type = 'AudioPlayer.Play';
		$this->setPlayBehavior($playBehavior);
		$this->setAudioItem($audioItem);
	}


	/**
	 * @return string
	 */
	public function getPlayBehavior() {
		return $this->playBehavior;
	}

	/**
	 * @param string $playBehavior
	 *
	 * @return Play
	 *
	 * @throws InvalidArgumentException
	 */
	public function setPlayBehavior($playBehavior) {
		if(!in_array($playBehavior, self::PLAY_BEHAVIORS)) {
			throw new InvalidArgumentException('PlayBehavior must be one of ' . implode(', ', self::PLAY_BEHAVIORS));
		}

		$this->playBehavior = $playBehavior;

		return $this;
	}

	/**
	 * @return AudioItem
	 */
	public function getAudioItem() {
		return $this->audioItem;
	}

	/**
	 * @param AudioItem $audioItem
	 *
	 * @return Play
	 */
	public function setAudioItem($audioItem) {
		$this->audioItem = $audioItem;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		return [
			'type' => $this->getType(),
			'playBehavior' => $this->getPlayBehavior(),
			'audioItem' => $this->getAudioItem()->render(),
		];
	}
}
