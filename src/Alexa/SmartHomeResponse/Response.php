<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeResponse;

/**
 * Class Response
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Response {
	/** @var $event */
	protected $event;


	/**
	 * @param array $responseData
	 */
	public function __construct($responseData) {
//		$this->event = new Event($response['event']);
	}
}
