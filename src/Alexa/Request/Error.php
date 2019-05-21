<?php

namespace InternetOfVoice\LibVoice\Alexa\Request;

/**
 * Class Error
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Error {
	/** @var string $type */
	protected $type;

	/** @var string $message */
	protected $message;


	/**
	 * @param array $errorData
	 */
	public function __construct($errorData) {
		if(isset($errorData['type'])) {
			$this->type = $errorData['type'];
		}

		if(isset($errorData['message'])) {
			$this->message = $errorData['message'];
		}
	}


	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getMessage() {
		return $this->message;
	}
}
