<?php

namespace InternetOfVoice\LibVoice\AlexaRequest\Request\Intent;

class Intent {
	/** @var string $name */
	protected $name;

	/** @var string $confirmationStatus */
	protected $confirmationStatus;

	/** @var array $slots */
	protected $slots;


	/**
	 * @param   array $intentData
	 */
	public function __construct($intentData) {
		$this->name = $intentData['name'];
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
	public function getName() {
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getConfirmationStatus() {
		return $this->confirmationStatus;
	}

	/**
	 * @return array
	 */
	public function getSlots() {
		return $this->slots;
	}

	/**
	 * @return mixed
	 */
	public function getSlot($name, $default = false) {
		return isset($this->slots[$name]) ? $this->slots[$name] : $default;
	}
}
