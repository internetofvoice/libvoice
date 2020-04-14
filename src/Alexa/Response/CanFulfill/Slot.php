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
	/** @var array CAN_FULFILL_VALUES */
	const CAN_FULFILL_VALUES = ['YES', 'NO'];

	/** @var array CAN_UNDERSTAND_VALUES */
	const CAN_UNDERSTAND_VALUES = ['YES', 'NO', 'MAYBE'];

	/** @var string $canUnderstand */
	protected $canUnderstand = 'NO';

	/** @var string $canFulfill */
	protected $canFulfill = 'NO';


	/**
	 * @param  string $canUnderstand
	 * @param  string $canFulfill
	 */
	public function __construct(string $canUnderstand, string $canFulfill) {
		$this->setCanUnderstand($canUnderstand);
		$this->setCanFulfill($canFulfill);
	}


	/**
	 * @return string
	 */
	public function getCanUnderstand(): string {
		return $this->canUnderstand;
	}

	/**
	 * @param string $canUnderstand
	 *
	 * @return Slot
	 */
	public function setCanUnderstand(string $canUnderstand): Slot {
		if(!in_array($canUnderstand, self::CAN_UNDERSTAND_VALUES)) {
			throw new InvalidArgumentException('Not a valid canFulfill value: ' . $canUnderstand . '.');
		}

		$this->canUnderstand = $canUnderstand;

		return $this;
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
	 * @return Slot
	 */
	public function setCanFulfill(string $canFulfill): Slot {
		if(!in_array($canFulfill, self::CAN_FULFILL_VALUES)) {
			throw new InvalidArgumentException('Not a valid canFulfill value: ' . $canFulfill . '.');
		}

		$this->canFulfill = $canFulfill;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'canUnderstand' => $this->getCanUnderstand(),
			'canFulfill' => $this->getCanFulfill(),
		];
	}
}
