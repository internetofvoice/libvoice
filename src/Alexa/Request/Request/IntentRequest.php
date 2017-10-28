<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request;

use \InternetOfVoice\LibVoice\Alexa\Request\Request\Intent\Intent;

/**
 * Class IntentRequest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class IntentRequest extends AbstractRequest {
	/** @var string $dialogState */
	protected $dialogState;

	/** @var Intent $intent */
	protected $intent;


	/**
	 * @param array $requestData
	 */
	public function __construct($requestData) {
		parent::__construct($requestData);

		$this->intent = new Intent($requestData['intent']);
		if (isset($requestData['dialogState'])) {
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
