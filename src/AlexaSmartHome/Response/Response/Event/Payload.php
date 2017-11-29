<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event;

use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Endpoint;
use \InvalidArgumentException;


/**
 * Class Payload
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Payload {
	/**
	 * @var int MAX_ENDPOINTS
	 * @see https://developer.amazon.com/de/docs/device-apis/alexa-discovery.html#discoverresponse
	 */
	const MAX_ENDPOINTS = 300;

    /** @var Endpoint[] $endpoints */
    protected $endpoints = [];

	/** @var string $type */
    protected $type;

	/** @var string $message */
    protected $message;


	/**
	 * @param array $payloadData
	 */
	public function __construct($payloadData = []) {
		if(isset($payloadData['endpoints'])) {
			$this->setEndpoints($payloadData['endpoints']);
		}

		if(isset($payloadData['type'])) {
			$this->setType($payloadData['type']);
		}

		if(isset($payloadData['message'])) {
			$this->setMessage($payloadData['message']);
		}
	}


	/**
     * @return  Endpoint[]
     */
    public function getEndpoints() {
        return $this->endpoints;
    }

    /**
     * @param   Endpoint[] $endpoints
     * @return  Payload
     */
    public function setEndpoints($endpoints) {
        foreach($endpoints as $endpoint) {
            $this->addEndpoint($endpoint);
        }

        return $this;
    }

    /**
     * @param   Endpoint $endpoint
     * @return  Payload
     * @throws  InvalidArgumentException
     */
    public function addEndpoint($endpoint) {
	    if(count($this->endpoints) < self::MAX_ENDPOINTS) {
		    array_push($this->endpoints, $endpoint);
	    } else {
		    throw new InvalidArgumentException('Allowed maximum of Endpoints (' . self::MAX_ENDPOINTS . ') reached.');
	    }

        return $this;
    }

	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param string $type
	 *
	 * @return Payload
	 */
	public function setType($type) {
		$this->type = $type;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * @param string $message
	 *
	 * @return Payload
	 */
	public function setMessage($message) {
		$this->message = $message;

		return $this;
	}


    /**
     * @return  array
     */
    function render() {
        $rendered = [];

        if(count($this->getEndpoints())) {
	        $renderedEndpoints = [];
	        foreach($this->getEndpoints() as $endpoint) {
		        array_push($renderedEndpoints, $endpoint->render());
	        }

	        $rendered['endpoints'] = $renderedEndpoints;
        }

        if(!is_null($this->getType())) {
	        $rendered['type'] = $this->getType();
        }

	    if(!is_null($this->getMessage())) {
		    $rendered['message'] = $this->getMessage();
	    }

	    return $rendered;
    }
}
