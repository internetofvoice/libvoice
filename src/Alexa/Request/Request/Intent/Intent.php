<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\Intent;

use \InvalidArgumentException;

/**
 * Class Intent
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Intent {
	/** @var array VALID_CONFIRMATION_STATUS */
	const VALID_CONFIRMATION_STATUS = ['NONE', 'CONFIRMED', 'DENIED'];

	/** @var string $name */
	protected $name;

	/** @var string $confirmationStatus */
	protected $confirmationStatus;

	/** @var Slot[] $slots */
	protected $slots = [];


	/**
	 * @param array $intentData
	 */
	public function __construct(array $intentData = []) {
		if(isset($intentData['name'])) {
			$this->name = $intentData['name'];
		}

		if(isset($intentData['confirmationStatus'])) {
			$this->confirmationStatus = $intentData['confirmationStatus'];
		}

		if(isset($intentData['slots']) && is_array($intentData['slots'])) {
			foreach($intentData['slots'] as $slotData) {
				$this->slots[$slotData['name']] = new Slot($slotData);
			}
		}
	}


	/**
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * @param  string $name
	 *
	 * @return Intent
	 */
	public function setName(string $name): Intent {
		$this->name = $name;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getConfirmationStatus(): string {
		return $this->confirmationStatus;
	}

	/**
	 * @param  string $confirmationStatus
	 *
	 * @return Intent
	 */
	public function setConfirmationStatus(string $confirmationStatus): Intent {
		if(!in_array($confirmationStatus, self::VALID_CONFIRMATION_STATUS)) {
			throw new InvalidArgumentException('Intent confirmationStatus must be one of ' . implode(', ', self::VALID_CONFIRMATION_STATUS));
		}

		$this->confirmationStatus = $confirmationStatus;

		return $this;
	}

	/**
	 * @return Slot[]
	 */
	public function getSlots(): array {
		return $this->slots;
	}

	/**
	 * Get slots as [name1 => value1, name2 => value2, ...]
	 *
	 * @return array
	 */
	public function getSlotsAsArray(): array {
		$slots = [];
		foreach($this->getSlots() as $name => $slot) {
			$slots[$name] = $slot->getValue();
		}

		return $slots;
	}

	/**
	 * @param string $name
	 *
	 * @return null|Slot
	 */
	public function getSlot(string $name): ?Slot {
		return isset($this->slots[$name]) ? $this->slots[$name] : null;
	}

	/**
	 * @param  Slot[] $slots
	 *
	 * @return Intent
	 */
	public function setSlots(array $slots): Intent {
		$this->slots = [];
		foreach($slots as $slot) {
			$this->addSlot($slot);
		}

		return $this;
	}

	/**
	 * @param  Slot $slot
	 *
	 * @return Intent
	 */
	public function addSlot(Slot $slot): Intent {
		$this->slots[$slot->getName()] = $slot;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		$result = [
			'name'               => $this->getName(),
			'confirmationStatus' => $this->getConfirmationStatus(),
		];

		$slots = $this->getSlots();
		if(count($slots)) {
			$result['slots'] = [];
			foreach($slots as $name => $slot) {
				$result['slots'][$name] = $slot->render();
			}
		}

		return $result;
	}}
