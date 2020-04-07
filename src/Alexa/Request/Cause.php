<?php

namespace InternetOfVoice\LibVoice\Alexa\Request;

/**
 * Class Cause
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Cause {
	/** @var string $requestId */
	protected $requestId;


	/**
	 * @param array $causeData
	 */
	public function __construct(array $causeData) {
		if(isset($causeData['requestId'])) {
			$this->requestId = $causeData['requestId'];
		}
	}


	/**
	 * @return string
	 */
	public function getRequestId(): string {
		return $this->requestId;
	}
}
