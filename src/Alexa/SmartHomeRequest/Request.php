<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeRequest;

use \InternetOfVoice\LibVoice\Alexa\SmartHomeRequest\Request\Directive;

/**
 * Class Request
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Request {
	/** @var Directive $directive */
	protected $directive;


	/**
	 * @param array $requestData
	 */
	public function __construct($requestData) {
		$this->directive = new Directive($requestData['directive']);
	}


	/**
	 * @return Directive
	 */
	public function getDirective() {
		return $this->directive;
	}
}
