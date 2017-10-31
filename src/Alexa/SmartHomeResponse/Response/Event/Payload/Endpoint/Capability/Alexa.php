<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event\Payload\Endpoint\Capability;

/**
 * Class Alexa
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Alexa extends AbstractCapability {
	public function __construct() {
		parent::__construct();

		$this->type = 'AlexaInterface';
		$this->interface = 'Alexa';
		$this->version = '3';
	}


	/**
	 * @return array
	 */
	public function render() {
		$rendered = [
			'type' => $this->getType(),
			'interface' => $this->getInterface(),
			'version' => $this->getVersion(),
		];

		return $rendered;
	}
}
