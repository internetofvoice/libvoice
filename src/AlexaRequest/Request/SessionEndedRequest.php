<?php

namespace InternetOfVoice\LibVoice\AlexaRequest\Request;

use stdClass;

class SessionEndedRequest extends AbstractRequest {
	/** @var string $reason */
	protected $reason;

	/** @var stdClass $error */
	protected $error;

	/**
	 * @param   array $requestData
	 */
	public function __construct($requestData) {
		parent::__construct($requestData);

		if(isset($requestData['reason'])) {
			$this->reason = $requestData['reason'];
		}

		if(isset($requestData['error'])) {
			$this->error = json_encode(json_decode($requestData['error']));
		}
	}


	/**
	 * @return string
	 */
	public function getReason() {
		return $this->reason;
	}

	/**
	 * @return stdClass
	 */
	public function getError() {
		return $this->error;
	}
}
