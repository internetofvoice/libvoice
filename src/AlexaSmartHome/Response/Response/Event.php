<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response;

use \InvalidArgumentException;
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
	 * @param Header   $header
	 * @param Payload  $payload
	 * @param Endpoint $endpoint
	 */
	public function __construct(Header $header = null, Payload $payload = null, Endpoint $endpoint = null) {
		if(!is_null($header)) {
			$this->setHeader($header);
		}

		if(!is_null($payload)) {
			$this->setPayload($payload);
		}

		if(!is_null($endpoint)) {
			$this->setEndpoint($endpoint);
		}
	}


	/**
     * @return null|Header
     */
    public function getHeader(): ?Header {
        return $this->header;
    }

    /**
     * @param  Header $header
     *
     * @return Event
     */
    public function setHeader(Header $header): Event {
        $this->header = $header;

        return $this;
    }

    /**
     * @return null|Payload
     */
    public function getPayload(): ?Payload {
        return $this->payload;
    }

    /**
     * @param  Payload $payload
     *
     * @return Event
     */
    public function setPayload(Payload $payload): Event {
        $this->payload = $payload;

        return $this;
    }

    /**
     * @return null|Endpoint
     */
    public function getEndpoint(): ?Endpoint {
        return $this->endpoint;
    }

    /**
     * @param  Endpoint $endpoint
     *
     * @return Event
     */
    public function setEndpoint(Endpoint $endpoint): Event {
        $this->endpoint = $endpoint;

        return $this;
    }


    /**
     * @return  array
     * @throws  InvalidArgumentException
     */
    function render(): array {
    	if(is_null($this->getHeader())) {
    		throw new InvalidArgumentException('Missing header.');
	    }

	    if(is_null($this->getPayload())) {
		    throw new InvalidArgumentException('Missing payload.');
	    }

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
