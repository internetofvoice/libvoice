<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request;

use \InternetOfVoice\LibVoice\Alexa\Request\Request\Intent\Intent;

/**
 * Class CanFulfillIntentRequest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class CanFulfillIntentRequest extends AbstractRequest {
	/** @var Intent $intent */
	protected $intent;


	/**
	 * @param array $requestData
	 */
	public function __construct(array $requestData) {
		parent::__construct($requestData);

		$this->intent = new Intent($requestData['intent']);
	}


	/**
	 * @return Intent
	 */
	public function getIntent(): Intent {
		return $this->intent;
	}
}
