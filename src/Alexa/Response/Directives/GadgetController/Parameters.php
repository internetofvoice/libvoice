<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\GadgetController;

use \InvalidArgumentException;

/**
 * Class Parameters
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Parameters {
	const TRIGGER_EVENTS = ['buttonDown', 'buttonUp', 'none'];
	const MIN_TRIGGER_EVENT_TIME = 0;
	const MAX_TRIGGER_EVENT_TIME = 65535;

	/** @var string $triggerEvent */
	protected $triggerEvent = 'none';

	/** @var int $triggerEventTimeMs */
	protected $triggerEventTimeMs = 0;

	/** @var Animations $animations */
	protected $animations;


	/**
	 * @param string     $triggerEvent
	 * @param int        $triggerEventTimeMs
	 * @param Animations $animations
	 */
	public function __construct($triggerEvent, $triggerEventTimeMs, $animations) {
		$this->setTriggerEvent($triggerEvent);
		$this->setTriggerEventTimeMs($triggerEventTimeMs);
		$this->setAnimations($animations);
	}


	/**
	 * @return string
	 */
	public function getTriggerEvent() {
		return $this->triggerEvent;
	}

	/**
	 * @param  string $triggerEvent
	 *
	 * @return Parameters
	 * @throws InvalidArgumentException
	 */
	public function setTriggerEvent($triggerEvent) {
		if(!in_array($triggerEvent, self::TRIGGER_EVENTS)) {
			throw new InvalidArgumentException('TriggerEvent must be one of ' . implode(', ', self::TRIGGER_EVENTS));
		}

		$this->triggerEvent = $triggerEvent;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getTriggerEventTimeMs() {
		return $this->triggerEventTimeMs;
	}

	/**
	 * @param  int $triggerEventTimeMs
	 *
	 * @return Parameters
	 * @throws InvalidArgumentException
	 */
	public function setTriggerEventTimeMs($triggerEventTimeMs) {
		if(!is_int($triggerEventTimeMs) || $triggerEventTimeMs < self::MIN_TRIGGER_EVENT_TIME || $triggerEventTimeMs > self::MAX_TRIGGER_EVENT_TIME) {
			throw new InvalidArgumentException('TriggerEventTimeMs must be a number between ' . self::MIN_TRIGGER_EVENT_TIME . ' and ' . self::MAX_TRIGGER_EVENT_TIME);
		}

		$this->triggerEventTimeMs = $triggerEventTimeMs;

		return $this;
	}

	/**
	 * @return Animations
	 */
	public function getAnimations() {
		return $this->animations;
	}

	/**
	 * @param  Animations $animations
	 *
	 * @return Parameters
	 */
	public function setAnimations($animations) {
		$this->animations = $animations;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		$rendered = [
			'triggerEvent'       => $this->getTriggerEvent(),
			'triggerEventTimeMs' => $this->getTriggerEventTimeMs(),
			'animations'         => $this->getAnimations()->render(),
		];

		return $rendered;
	}
}
