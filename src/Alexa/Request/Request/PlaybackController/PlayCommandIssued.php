<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\PlaybackController;

use \InternetOfVoice\LibVoice\Alexa\Request\Request\AbstractRequest;

/**
 * Class PlayCommandIssued
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class PlayCommandIssued extends AbstractRequest {
	/**
	 * @param array $requestData
	 */
	public function __construct($requestData) {
		parent::__construct($requestData);
	}
}
