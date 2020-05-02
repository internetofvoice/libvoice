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
	/** @var array TRIGGER_EVENTS */
	const TRIGGER_EVENTS = ['buttonDown', 'buttonUp', 'none'];

	/** @var int MIN_TRIGGER_EVENT_TIME */
	const MIN_TRIGGER_EVENT_TIME = 0;

	/** @var int MAX_TRIGGER_EVENT_TIME */
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
	public function __construct(string $triggerEvent, int $triggerEventTimeMs, Animations $animations) {
		$this->setTriggerEvent($triggerEvent);
		$this->setTriggerEventTimeMs($triggerEventTimeMs);
		$this->setAnimations($animations);
	}


	/**
	 * @return string
	 */
	public function getTriggerEvent(): string {
		return $this->triggerEvent;
	}

	/**
	 * @param  string $triggerEvent
	 *
	 * @return Parameters
	 * @throws InvalidArgumentException
	 */
	public function setTriggerEvent(string $triggerEvent): Parameters {
		if(!in_array($triggerEvent, self::TRIGGER_EVENTS)) {
			throw new InvalidArgumentException('TriggerEvent must be one of ' . implode(', ', self::TRIGGER_EVENTS));
		}

		$this->triggerEvent = $triggerEvent;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getTriggerEventTimeMs(): int {
		return $this->triggerEventTimeMs;
	}

	/**
	 * @param  int $triggerEventTimeMs
	 *
	 * @return Parameters
	 * @throws InvalidArgumentException
	 */
	public function setTriggerEventTimeMs(int $triggerEventTimeMs): Parameters {
		if(!is_int($triggerEventTimeMs) || $triggerEventTimeMs < self::MIN_TRIGGER_EVENT_TIME || $triggerEventTimeMs > self::MAX_TRIGGER_EVENT_TIME) {
			throw new InvalidArgumentException('TriggerEventTimeMs must be a number between ' . self::MIN_TRIGGER_EVENT_TIME . ' and ' . self::MAX_TRIGGER_EVENT_TIME);
		}

		$this->triggerEventTimeMs = $triggerEventTimeMs;

		return $this;
	}

	/**
	 * @return Animations
	 */
	public function getAnimations(): Animations {
		return $this->animations;
	}

	/**
	 * @param  Animations $animations
	 *
	 * @return Parameters
	 */
	public function setAnimations(Animations $animations): Parameters {
		$this->animations = $animations;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'triggerEvent'       => $this->getTriggerEvent(),
			'triggerEventTimeMs' => $this->getTriggerEventTimeMs(),
			'animations'         => $this->getAnimations()->render(),
		];
	}
}
