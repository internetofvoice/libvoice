<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Request;

use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Endpoint;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Request\Request\Directive\Header;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Request\Request\Directive\Payload;
use \InvalidArgumentException;

/**
 * Class AlexaRequest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class AlexaRequest {
	/** @var Request $request */
	protected $request;

	/** @var Context $context */
	protected $context;


	/**
	 * @param  string $rawData
	 * @param  string $signature
	 * @param  string $signatureKey
	 * @param  bool   $validateSignature
	 * @param  bool   $validateTimestamp
	 * @throws InvalidArgumentException
	 */
	public function __construct($rawData, $signature = '', $signatureKey = '', $validateSignature = true, $validateTimestamp = true) {
		$data = json_decode($rawData, true);

		// Validation

		if(!isset($data['request'])) {
			throw new InvalidArgumentException('Missing request data.');
		}

		if(!isset($data['context'])) {
			throw new InvalidArgumentException('Missing context data.');
		}

		$this->request = new Request($data['request']);
		$this->context = new Context($data['context']);
	}


	/**
	 * @return Request
	 */
	public function getRequest() {
		return $this->request;
	}

	/**
	 * @return Context
	 */
	public function getContext() {
		return $this->context;
	}


    /**
     * Shortcut to Directive Header
     *
     * @return Header
     */
    public function getHeader() {
        return $this->getRequest()->getDirective()->getHeader();
    }

    /**
     * Shortcut to Directive Payload
     *
     * @return Payload
     */
    public function getPayload() {
        return $this->getRequest()->getDirective()->getPayload();
    }

	/**
	 * Shortcut to Directive Endpoint
	 *
	 * @return Endpoint
	 */
	public function getEndpoint() {
		return $this->getRequest()->getDirective()->getEndpoint();
	}
}
