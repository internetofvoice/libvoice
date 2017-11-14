<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Endpoint;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event\Header;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event\Payload;

/**
 * Class Event
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Event {
	/** @var Header $header */
	protected $header;

	/** @var Payload $payload */
	protected $payload;

    /** @var Endpoint $endpoint */
    protected $endpoint;


	/**
	 * @param Header $header
	 * @param Payload $payload
	 * @param Endpoint $endpoint
	 */
	public function __construct($header = null, $payload = null, $endpoint = null) {
		$this->setHeader($header);
		$this->setPayload($payload);
        $this->setEndpoint($endpoint);
	}


	/**
     * @return Header
     */
    public function getHeader() {
        return $this->header;
    }

    /**
     * @param Header $header
     * @return Event
     */
    public function setHeader($header) {
        $this->header = $header;
        return $this;
    }

    /**
     * @return Payload
     */
    public function getPayload() {
        return $this->payload;
    }

    /**
     * @param Payload $payload
     * @return Event
     */
    public function setPayload($payload) {
        $this->payload = $payload;
        return $this;
    }

    /**
     * @return Endpoint
     */
    public function getEndpoint() {
        return $this->endpoint;
    }

    /**
     * @param Endpoint $endpoint
     * @return Event
     */
    public function setEndpoint($endpoint) {
        $this->endpoint = $endpoint;
        return $this;
    }


    /**
     * @return  array
     */
    function render() {
        $rendered = [
	        'header'  => $this->getHeader()->render(),
	        'payload' => $this->getPayload()->render(),
        ];

        if(!is_null($this->getEndpoint())) {
            $rendered['endpoint'] = $this->getEndpoint()->render();
        }

        return $rendered;
    }
}
