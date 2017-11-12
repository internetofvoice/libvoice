<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Request\Request;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Endpoint;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Request\Request\Directive\Header;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Request\Request\Directive\Payload;
use \InvalidArgumentException;

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

	/** @var Endpoint $endpoint */
	protected $endpoint;


	/**
	 * @param array $directiveData
	 * @throws InvalidArgumentException
	 */
	public function __construct($directiveData) {
		if(!isset($directiveData['header'])) {
			throw new InvalidArgumentException('Missing header data.');
		}

		if(!isset($directiveData['payload'])) {
			throw new InvalidArgumentException('Missing payload data.');
		}

		$this->header = new Header($directiveData['header']);
		$this->payload = new Payload($directiveData['payload']);

		if(isset($directiveData['endpoint'])) {
			$this->endpoint = new Endpoint($directiveData['endpoint']);
		}
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

	/**
	 * @return Endpoint
	 */
	public function getEndpoint() {
		return $this->endpoint;
	}
}
