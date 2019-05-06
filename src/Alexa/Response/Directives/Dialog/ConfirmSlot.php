<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\Dialog;

use InternetOfVoice\LibVoice\Alexa\Response\Directives\AbstractDialog;

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
	 * @param $updatedIntent
	 */
	public function __construct($updatedIntent) {
		parent::__construct($updatedIntent);

		$this->type = 'Dialog.ConfirmSlot';
	}


	/**
	 * @return string
	 */
	public function getSlotToConfirm() {
		return $this->slotToConfirm;
	}

	/**
	 * @param  string $slotToConfirm
	 *
	 * @return ConfirmSlot
	 */
	public function setSlotToConfirm($slotToConfirm) {
		$this->slotToConfirm = $slotToConfirm;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		return [
			'type'          => $this->getType(),
			'slotToConfirm' => $this->getSlotToConfirm(),
			'updatedIntent' => $this->getUpdatedIntent(),
		];
	}
}
