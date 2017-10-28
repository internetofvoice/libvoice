<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request;

use \stdClass;

/**
 * Class SessionEndedRequest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class SessionEndedRequest extends AbstractRequest {
	/** @var string $reason */
	protected $reason;

	/** @var stdClass $error */
	protected $error;


	/**
	 * @param array $requestData
	 */
	public function __construct($requestData) {
		parent::__construct($requestData);

		if (isset($requestData['reason'])) {
			$this->reason = $requestData['reason'];
		}

		if (isset($requestData['error'])) {
			$this->error = json_decode(json_encode($requestData['error']));
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
