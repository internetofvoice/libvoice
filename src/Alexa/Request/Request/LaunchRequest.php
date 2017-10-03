<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request;

/**
 * Class LaunchRequest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class LaunchRequest extends AbstractRequest {
	/**
	 * @param array $requestData
	 */
	public function __construct($requestData) {
		parent::__construct($requestData);
	}
}
