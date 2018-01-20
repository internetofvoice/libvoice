<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\Intent;

/**
 * Class ResolutionStatus
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ResolutionStatus {
	/** @var string $code */
	protected $code;


	/**
	 * @param array $data
	 */
	public function __construct($data) {
		if(isset($data['code'])) {
			$this->code = $data['code'];
		}
	}


	/**
	 * @return string
	 */
	public function getCode() {
		return $this->code;
	}
}
