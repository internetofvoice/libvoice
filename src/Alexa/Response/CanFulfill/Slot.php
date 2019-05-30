<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\CanFulfill;

use \InvalidArgumentException;

/**
 * Class Slot
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Slot {
	const CAN_FULFILL_VALUES = ['YES', 'NO'];
	const CAN_UNDERSTAND_VALUES = ['YES', 'NO', 'MAYBE'];

	/** @var string $canUnderstand */
	protected $canUnderstand = 'NO';

	/** @var string $canFulfill */
	protected $canFulfill = 'NO';


	/**
	 * @param  string $canUnderstand
	 * @param  string $canFulfill
	 */
	public function __construct($canUnderstand, $canFulfill) {
		$this->setCanUnderstand($canUnderstand);
		$this->setCanFulfill($canFulfill);
	}


	/**
	 * @return string
	 */
	public function getCanUnderstand() {
		return $this->canUnderstand;
	}

	/**
	 * @param string $canUnderstand
	 *
	 * @return Slot
	 */
	public function setCanUnderstand($canUnderstand) {
		if(!in_array($canUnderstand, self::CAN_UNDERSTAND_VALUES)) {
			throw new InvalidArgumentException('Not a valid canFulfill value: ' . $canUnderstand . '.');
		}

		$this->canUnderstand = $canUnderstand;

		return $this;
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
	 * @return Slot
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
	public function render() {
		$result = [
			'canUnderstand' => $this->getCanUnderstand(),
			'canFulfill' => $this->getCanFulfill(),
		];

		return $result;
	}
}
