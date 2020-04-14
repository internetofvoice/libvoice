<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\CanFulfill;

use \InvalidArgumentException;

/**
 * Class CanFulfillIntent
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class CanFulfillIntent {
	/** @var array CAN_FULFILL_VALUES */
	const CAN_FULFILL_VALUES = ['YES', 'NO'];

	/** @var string $canFulfill */
	protected $canFulfill = 'NO';

	/** @var Slot[] $slots */
	protected $slots = [];


	/**
	 * @param  string $canFulfill
	 */
	public function __construct(string $canFulfill) {
		$this->setCanFulfill($canFulfill);
	}


	/**
	 * @return string
	 */
	public function getCanFulfill(): string {
		return $this->canFulfill;
	}

	/**
	 * @param  string $canFulfill
	 *
	 * @return CanFulfillIntent
	 */
	public function setCanFulfill(string $canFulfill): CanFulfillIntent {
		if(!in_array($canFulfill, self::CAN_FULFILL_VALUES)) {
			throw new InvalidArgumentException('Not a valid canFulfill value: ' . $canFulfill . '.');
		}

		$this->canFulfill = $canFulfill;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getSlots(): array {
		return $this->slots;
	}

	/**
	 * @param  string $name
	 *
	 * @return null|Slot
	 */
	public function getSlot(string $name): ?Slot {
		return $this->slots[$name] ?: null;
	}

	/**
	 * @param  array $slots
	 *
	 * @return CanFulfillIntent
	 */
	public function setSlots(array $slots): CanFulfillIntent {
		$this->slots = [];
		foreach($slots as $name => $slot) {
			$this->addSlot($name, $slot);
		}

		return $this;
	}

	/**
	 * @param  string $name
	 * @param  Slot   $slot
	 *
	 * @return CanFulfillIntent
	 */
	public function addSlot(string $name, Slot $slot): CanFulfillIntent {
		$this->slots[$name] = $slot;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		$rendered = [
			'canFulfill' => $this->getCanFulfill(),
		];

		$slots = $this->getSlots();
		if(count($slots)) {
			$rendered['slots'] = [];

			/**
			 * @var string $name
			 * @var Slot   $slot
			 */
			foreach($slots as $name => $slot) {
				$rendered['slots'][$name] = $slot->render();
			}
		}

		return $rendered;
	}
}
