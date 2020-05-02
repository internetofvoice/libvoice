<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\Dialog;

use InternetOfVoice\LibVoice\Alexa\Request\Request\Intent\Intent;

/**
 * Class ConfirmSlot
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ConfirmSlot extends AbstractDialog {
	/** @var string $slotToConfirm */
	protected $slotToConfirm;


	/**
	 * @param Intent $updatedIntent
	 */
	public function __construct(Intent $updatedIntent) {
		parent::__construct($updatedIntent);

		$this->type = 'Dialog.ConfirmSlot';
	}


	/**
	 * @return string
	 */
	public function getSlotToConfirm(): string {
		return $this->slotToConfirm;
	}

	/**
	 * @param  string $slotToConfirm
	 *
	 * @return ConfirmSlot
	 */
	public function setSlotToConfirm(string $slotToConfirm): ConfirmSlot {
		$this->slotToConfirm = $slotToConfirm;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'type'          => $this->getType(),
			'slotToConfirm' => $this->getSlotToConfirm(),
			'updatedIntent' => $this->getUpdatedIntent()->render(),
		];
	}
}
