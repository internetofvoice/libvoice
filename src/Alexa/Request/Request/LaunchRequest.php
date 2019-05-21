<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request;

/**
 * Class LaunchRequest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class LaunchRequest extends AbstractRequest {
	/** @var bool $shouldLinkResultBeReturned */
	protected $shouldLinkResultBeReturned;


	/**
	 * @param array $requestData
	 */
	public function __construct($requestData) {
		parent::__construct($requestData);

		if(isset($requestData['shouldLinkResultBeReturned'])) {
			$this->shouldLinkResultBeReturned = boolval($requestData['shouldLinkResultBeReturned']);
		}
	}


	/**
	 * @return bool
	 */
	public function shouldLinkResultBeReturned() {
		return $this->shouldLinkResultBeReturned;
	}
}
