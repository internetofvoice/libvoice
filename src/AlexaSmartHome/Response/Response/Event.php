<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response;

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


	/**
	 * @param Header $header
	 * @param Payload $payload
	 */
	public function __construct($header = null, $payload = null) {
		$this->setHeader($header);
		$this->setPayload($payload);
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
     * @return  array
     */
    function render() {
        $rendered = [
	        'header'  => $this->getHeader()->render(),
	        'payload' => $this->getPayload()->render(),
        ];

        return $rendered;
    }
}
