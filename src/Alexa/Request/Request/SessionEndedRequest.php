<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request;

use \InternetOfVoice\LibVoice\Alexa\Request\Error;

/**
 * Class SessionEndedRequest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class SessionEndedRequest extends AbstractRequest {
	/** @var string $reason */
	protected $reason;

	/** @var Error $error */
	protected $error;


	/**
	 * @param array $requestData
	 */
	public function __construct(array $requestData) {
		parent::__construct($requestData);

		if (isset($requestData['reason'])) {
			$this->reason = $requestData['reason'];
		}

		if (isset($requestData['error'])) {
			$this->error = new Error($requestData['error']);
		}
	}


	/**
	 * @return string
	 */
	public function getReason(): string {
		return $this->reason;
	}

	/**
	 * @return Error
	 */
	public function getError(): Error {
		return $this->error;
	}
}
