<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\System;

use \InternetOfVoice\LibVoice\Alexa\Request\Cause;
use \InternetOfVoice\LibVoice\Alexa\Request\Error;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\AbstractRequest;

/**
 * Class ExceptionEncountered
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ExceptionEncountered extends AbstractRequest {
	/** @var Error $error */
	protected $error;

	/** @var Cause $cause */
	protected $cause;


	/**
	 * @param array $requestData
	 */
	public function __construct($requestData) {
		parent::__construct($requestData);

		if(isset($requestData['error'])) {
			$this->error = new Error($requestData['error']);
		}

		if(isset($requestData['cause'])) {
			$this->cause = new Cause($requestData['cause']);
		}
	}


	/**
	 * @return Error
	 */
	public function getError() {
		return $this->error;
	}

	/**
	 * @return Cause
	 */
	public function getCause() {
		return $this->cause;
	}
}
