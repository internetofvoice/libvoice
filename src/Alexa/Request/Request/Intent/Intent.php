<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\Intent;

/**
 * Class Intent
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
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
		if (isset($intentData['confirmationStatus'])) {
			$this->confirmationStatus = $intentData['confirmationStatus'];
		}

		if (isset($intentData['slots']) && is_array($intentData['slots'])) {
			foreach ($intentData['slots'] as $slotData) {
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
	 * @return Slot[]
	 */
	public function getSlots() {
		return $this->slots;
	}

	/**
	 * @param string $name
	 *
	 * @return Slot
	 */
	public function getSlot($name) {
		return isset($this->slots[$name]) ? $this->slots[$name] : null;
	}
}