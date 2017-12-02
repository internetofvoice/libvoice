<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\System;

use \InternetOfVoice\LibVoice\Alexa\Request\Request\AbstractRequest;
use \stdClass;

/**
 * Class ExceptionEncountered
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ExceptionEncountered extends AbstractRequest {
	/** @var stdClass $error */
	protected $error;

	/** @var stdClass $cause */
	protected $cause;


	/**
	 * @param array $requestData
	 */
	public function __construct($requestData) {
		parent::__construct($requestData);

		if(isset($requestData['error'])) {
			$this->error = json_decode(json_encode($requestData['error']));
		}

		if(isset($requestData['cause'])) {
			$this->cause = json_decode(json_encode($requestData['cause']));
		}
	}


	/**
	 * @return stdClass
	 */
	public function getError() {
		return $this->error;
	}

	/**
	 * @return stdClass
	 */
	public function getCause() {
		return $this->cause;
	}
}
