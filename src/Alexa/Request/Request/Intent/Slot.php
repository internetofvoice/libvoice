<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\Intent;

use \InvalidArgumentException;

/**
 * Class Slot
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Slot {
	const VALID_CONFIRMATION_STATUS = ['NONE', 'CONFIRMED', 'DENIED'];

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
	 * @param array $slotData
	 */
	public function __construct($slotData = []) {
		if(isset($slotData['name'])) {
			$this->name = $slotData['name'];
		}

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
	 * @param  string $name
	 *
	 * @return Slot
	 */
	public function setName($name) {
		$this->name = $name;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param  mixed $value
	 *
	 * @return Slot
	 */
	public function setValue($value) {
		$this->value = $value;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getConfirmationStatus() {
		return $this->confirmationStatus;
	}

	/**
	 * @param  string $confirmationStatus
	 *
	 * @return Slot
	 * @throws InvalidArgumentException
	 */
	public function setConfirmationStatus($confirmationStatus) {
		if(!in_array($confirmationStatus, self::VALID_CONFIRMATION_STATUS)) {
			throw new InvalidArgumentException('Slot confirmationStatus must be one of ' . implode(', ', self::VALID_CONFIRMATION_STATUS));
		}

		$this->confirmationStatus = $confirmationStatus;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSource() {
		return $this->source;
	}

	/**
	 * @param  string $source
	 *
	 * @return Slot
	 */
	public function setSource($source) {
		$this->source = $source;

		return $this;
	}

	/**
	 * @return Resolutions
	 */
	public function getResolutions() {
		return $this->resolutions;
	}

	/**
	 * @param  Resolutions $resolutions
	 *
	 * @return Slot
	 */
	public function setResolutions($resolutions) {
		$this->resolutions = $resolutions;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		$result = [
			'name'               => $this->getName(),
			'value'              => $this->getValue(),
			'confirmationStatus' => $this->getConfirmationStatus(),
			'resolutions'        => $this->getResolutions()->render(),
		];

		if($this->getSource()) {
			$result['source'] = $this->getSource();
		}

		return $result;
	}
}
