<?php

namespace InternetOfVoice\LibVoice\AlexaRequest\Request\Intent;

class Slot {
	/** @var string $name */
	protected $name;

	/** @var mixed $value */
	protected $value;

	/** @var string $confirmationStatus */
	protected $confirmationStatus;

	//@ TODO resolutions

	/**
	 * @param   array $slotData
	 */
	public function __construct($slotData) {
		$this->name = $slotData['name'];

		if(isset($slotData['value'])) {
			$this->value = $slotData['value'];
		}

		if(isset($slotData['confirmationStatus'])) {
			$this->confirmationStatus = $slotData['confirmationStatus'];
		}
	}


	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return mixed
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @return string
	 */
	public function getConfirmationStatus() {
		return $this->confirmationStatus;
	}
}
