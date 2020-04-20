<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Endpoint;
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
    protected $type = '';

	/** @var string $message */
    protected $message = '';

	/** @var array $values */
	protected $values = [];


	/**
	 * @param array $payloadData
	 */
	public function __construct(array $payloadData = []) {
		if(isset($payloadData['endpoints'])) {
			$this->setEndpoints($payloadData['endpoints']);
		}

		if(isset($payloadData['type'])) {
			$this->setType($payloadData['type']);
		}

		if(isset($payloadData['message'])) {
			$this->setMessage($payloadData['message']);
		}

		if(isset($payloadData['values'])) {
			$this->setValues($payloadData['values']);
		}
	}


	/**
     * @return  Endpoint[]
     */
    public function getEndpoints(): array {
        return $this->endpoints;
    }

    /**
     * @param   Endpoint[] $endpoints
     *
     * @return  Payload
     */
    public function setEndpoints(array $endpoints): Payload {
        foreach($endpoints as $endpoint) {
            $this->addEndpoint($endpoint);
        }

        return $this;
    }

    /**
     * @param   Endpoint $endpoint
     *
     * @return  Payload
     * @throws  InvalidArgumentException
     */
    public function addEndpoint(Endpoint $endpoint): Payload {
	    if(count($this->endpoints) >= self::MAX_ENDPOINTS) {
		    throw new InvalidArgumentException('Allowed maximum of Endpoints (' . self::MAX_ENDPOINTS . ') reached.');
	    }

	    array_push($this->endpoints, $endpoint);

	    return $this;
    }

	/**
	 * @return string
	 */
	public function getType(): string {
		return $this->type;
	}

	/**
	 * @param  string $type
	 *
	 * @return Payload
	 */
	public function setType(string $type): Payload {
		$this->type = $type;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getMessage(): string {
		return $this->message;
	}

	/**
	 * @param  string $message
	 *
	 * @return Payload
	 */
	public function setMessage(string $message): Payload {
		$this->message = $message;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getValues(): array {
		return $this->values;
	}

	/**
	 * @param  array $values
	 *
	 * @return Payload
	 */
	public function setValues(array $values): Payload {
		$this->values = $values;

		return $this;
	}

	/**
	 * @param  string $key
	 * @param  mixed  $value
	 *
	 * @return Payload
	 */
	public function addValue(string $key, $value): Payload {
		$this->values[$key] = $value;

		return $this;
	}


    /**
     * @return  array
     */
    function render(): array {
        $rendered = [];

        if(count($this->getEndpoints())) {
	        $renderedEndpoints = [];
	        foreach($this->getEndpoints() as $endpoint) {
		        array_push($renderedEndpoints, $endpoint->render());
	        }

	        $rendered['endpoints'] = $renderedEndpoints;
        }

        if($this->getType()) {
	        $rendered['type'] = $this->getType();
        }

	    if($this->getMessage()) {
		    $rendered['message'] = $this->getMessage();
	    }

	    foreach($this->getValues() as $key => $value) {
		    if(is_object($value)) {
			    $rendered[$key] = $value->render();
		    } elseif(is_array($value)) {
			    $values = array();
			    foreach($value as $v) {
				    if(is_object($v)) {
					    array_push($values, $v->render());
				    } else {
					    array_push($values, $v);
				    }
			    }

			    $rendered[$key] = $values;
		    } else {
			    $rendered[$key] = $value;
		    }
	    }

	    return $rendered;
    }
}
