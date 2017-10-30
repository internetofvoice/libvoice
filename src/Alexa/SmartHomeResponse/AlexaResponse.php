<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeResponse;

use \InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event;
use \InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event\Header;
use \InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event\Payload;

/**
 * Class AlexaResponse
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class AlexaResponse {
	/** @var Response $response */
	protected $response;

	/** @var Context $context */
	protected $context;


	/**
	 * @param Response $response
	 * @param Context $context
	 */
	public function __construct($response = null, $context = null) {
		$this->setResponse($response);
		$this->setContext($context);
	}

	/**
	 * Create AlexaResponse skeleton
	 *
	 * @return AlexaResponse
	 */
	public static function create() {
		return new AlexaResponse(
			new Response(
				new Event(
					new Header(),
					new Payload()
				)
			),
			new Context()
		);
	}


	/**
     * @return Response
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * @param Response $response
     * @return AlexaResponse
     */
    public function setResponse($response) {
        $this->response = $response;
        return $this;
    }

    /**
     * @return Context
     */
    public function getContext() {
        return $this->context;
    }

    /**
     * @param Context $context
     * @return AlexaResponse
     */
    public function setContext($context) {
        $this->context = $context;
        return $this;
    }


	/**
	 * Shortcut to Event Header
	 *
	 * @return Header
	 */
    public function getHeader() {
		return $this->getResponse()->getEvent()->getHeader();
    }

	/**
	 * Shortcut to Event Payload
	 *
	 * @return Payload
	 */
	public function getPayload() {
		return $this->getResponse()->getEvent()->getPayload();
	}


    /**
     * @return  array
     */
    function render() {
        $rendered = [
            'response' => $this->getResponse()->render(),
            'context' => $this->getContext()->render(),
        ];

        return $rendered;
    }
}
