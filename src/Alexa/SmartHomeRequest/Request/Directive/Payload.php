<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeRequest\Request\Directive;

use \InternetOfVoice\LibVoice\Alexa\SmartHomeRequest\Request\Directive\Payload\Scope;

/**
 * Class Payload
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Payload {
	/** @var Scope $scope  */
	protected $scope;


	/**
	 * @param array $payloadData
	 */
	public function __construct($payloadData) {
		if(isset($payloadData['scope'])) {
			$this->scope = new Scope($payloadData['scope']);
		}
	}


	/**
	 * @return Scope
	 */
	public function getScope() {
		return $this->scope;
	}
}
