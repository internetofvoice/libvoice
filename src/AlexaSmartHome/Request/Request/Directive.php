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
	 * @param  array $directiveData
	 *
	 * @throws InvalidArgumentException
	 */
	public function __construct(array $directiveData) {
		if(!isset($directiveData['header'])) {
			throw new InvalidArgumentException('Missing header data.');
		}

		if(!isset($directiveData['payload'])) {
			throw new InvalidArgumentException('Missing payload data.');
		}

		$this->header  = new Header($directiveData['header']);
		$this->payload = new Payload($directiveData['payload'], $this->getHeader()->getNamespace(), $this->getHeader()->getName());

		if(isset($directiveData['endpoint'])) {
			$this->endpoint = new Endpoint($directiveData['endpoint']);
		}
	}


	/**
	 * @return Header
	 */
	public function getHeader(): Header {
		return $this->header;
	}

	/**
	 * @return Payload
	 */
	public function getPayload(): Payload {
		return $this->payload;
	}

	/**
	 * @return null|Endpoint
	 */
	public function getEndpoint(): ?Endpoint {
		return $this->endpoint;
	}
}
