<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeRequest\Request;

use \InternetOfVoice\LibVoice\Alexa\SmartHomeRequest\Request\Directive\Header;
use \InternetOfVoice\LibVoice\Alexa\SmartHomeRequest\Request\Directive\Payload;

/**
 * Class Directive
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Directive {
	/** @var Header $header */
	protected $header;

	/** @var Payload $payload */
	protected $payload;


	/**
	 * @param array $directiveData
	 */
	public function __construct($directiveData) {
		$this->header = new Header($directiveData['header']);
		$this->payload = new Payload($directiveData['payload']);
	}


	/**
	 * @return Header
	 */
	public function getHeader() {
		return $this->header;
	}

	/**
	 * @return Payload
	 */
	public function getPayload() {
		return $this->payload;
	}
}
