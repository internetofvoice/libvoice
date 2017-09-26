<?php

namespace InternetOfVoice\LibVoice\AlexaRequest\Request;

class IntentRequest extends AbstractRequest {
	/** @var string $dialogState */
	protected $dialogState;

	/**
	 * @param   array $requestData
	 */
	public function __construct($requestData) {
		parent::__construct($requestData);

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
}
