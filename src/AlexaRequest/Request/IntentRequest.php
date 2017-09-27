<?php

namespace InternetOfVoice\LibVoice\AlexaRequest\Request;

use InternetOfVoice\LibVoice\AlexaRequest\Request\Intent\Intent;

class IntentRequest extends AbstractRequest {
	/** @var string $dialogState */
	protected $dialogState;

	/** @var Intent $intent */
	protected $intent;


	/**
	 * @param   array $requestData
	 */
	public function __construct($requestData) {
		parent::__construct($requestData);

		$this->intent = new Intent($requestData['intent']);
		if(isset($requestData['dialogState'])) {
			$this->dialogState = $requestData['dialogState'];
		}
	}


	/**
	 * @return string
	 */
	public function getDialogState() {
		return $this->dialogState;
	}

	/**
	 * @return Intent
	 */
	public function getIntent() {
		return $this->intent;
	}
}
