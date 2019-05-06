<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\Dialog;

use InternetOfVoice\LibVoice\Alexa\Response\Directives\AbstractDialog;

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
	 * @param $updatedIntent
	 */
	public function __construct($updatedIntent) {
		parent::__construct($updatedIntent);

		$this->type = 'Dialog.ElicitSlot';
	}


	/**
	 * @return string
	 */
	public function getSlotToElicit() {
		return $this->slotToElicit;
	}

	/**
	 * @param  string $slotToElicit
	 *
	 * @return ElicitSlot
	 */
	public function setSlotToElicit($slotToElicit) {
		$this->slotToElicit = $slotToElicit;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		return [
			'type'          => $this->getType(),
			'slotToElicit'  => $this->getSlotToElicit(),
			'updatedIntent' => $this->getUpdatedIntent(),
		];
	}
}
