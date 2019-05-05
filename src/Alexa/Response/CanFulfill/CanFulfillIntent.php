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
	const CAN_FULFILL_VALUES = ['YES', 'NO'];

	/** @var string $canFulfill */
	protected $canFulfill;

	/** @var Slot[] $slots */
	protected $slots = [];


	/**
	 * @param  string $canFulfill
	 */
	public function __construct($canFulfill) {
		$this->setCanFulfill($canFulfill);
	}


	/**
	 * @return string
	 */
	public function getCanFulfill() {
		return $this->canFulfill;
	}

	/**
	 * @param  string $canFulfill
	 *
	 * @return CanFulfillIntent
	 */
	public function setCanFulfill($canFulfill) {
		if(!in_array($canFulfill, self::CAN_FULFILL_VALUES)) {
			throw new InvalidArgumentException('Not a valid canFulfill value: ' . $canFulfill . '.');
		}

		$this->canFulfill = $canFulfill;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getSlots() {
		return $this->slots;
	}

	/**
	 * @param  string $name
	 *
	 * @return Slot
	 */
	public function getSlot($name) {
		return $this->slots[$name] ?: null;
	}

	/**
	 * @param  array $slots
	 *
	 * @return CanFulfillIntent
	 */
	public function setSlots($slots) {
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
	public function addSlot($name, $slot) {
		$this->slots[$name] = $slot;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
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
