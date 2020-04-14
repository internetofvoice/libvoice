<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\Dialog;

use InternetOfVoice\LibVoice\Alexa\Request\Request\Intent\Intent;

/**
 * Class ElicitSlot
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ElicitSlot extends AbstractDialog {
	/** @var string $slotToElicit */
	protected $slotToElicit;


	/**
	 * @param Intent $updatedIntent
	 */
	public function __construct(Intent $updatedIntent) {
		parent::__construct($updatedIntent);

		$this->type = 'Dialog.ElicitSlot';
	}


	/**
	 * @return string
	 */
	public function getSlotToElicit(): string {
		return $this->slotToElicit;
	}

	/**
	 * @param  string $slotToElicit
	 *
	 * @return ElicitSlot
	 */
	public function setSlotToElicit(string $slotToElicit): ElicitSlot {
		$this->slotToElicit = $slotToElicit;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'type'          => $this->getType(),
			'slotToElicit'  => $this->getSlotToElicit(),
			'updatedIntent' => $this->getUpdatedIntent()->render(),
		];
	}
}
