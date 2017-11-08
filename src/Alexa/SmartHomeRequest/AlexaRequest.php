<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeRequest;

use \InternetOfVoice\LibVoice\Alexa\SmartHomeRequest\Request\Directive\Header;
use \InternetOfVoice\LibVoice\Alexa\SmartHomeRequest\Request\Directive\Payload;

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
	 * @param array $data
	 */
	public function __construct($data) {
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
}
