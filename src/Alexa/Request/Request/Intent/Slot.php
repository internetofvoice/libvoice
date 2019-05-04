<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\Intent;

/**
 * Class Slot
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Slot {
	/** @var string $name */
	protected $name;

	/** @var mixed $value */
	protected $value;

	/** @var string $confirmationStatus */
	protected $confirmationStatus;

	/** @var string $source */
	protected $source;

	/** @var Resolutions $resolutions */
	protected $resolutions;


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

		if(isset($slotData['source'])) {
			$this->source = $slotData['source'];
		}

		if(isset($slotData['resolutions'])) {
			$this->resolutions = new Resolutions($slotData['resolutions']);
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

	/**
	 * @return string
	 */
	public function getSource() {
		return $this->source;
	}

	/**
	 * @return Resolutions
	 */
	public function getResolutions() {
		return $this->resolutions;
	}
}
