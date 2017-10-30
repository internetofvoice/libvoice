<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event;

/**
 * Class Payload
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 * @TODO    Add type hinting of every endpoint(s) parameter occurance
 */
class Payload {
    /** @var array $endpoints */
    protected $endpoints = [];


	/**
	 * @param array $payloadData
	 */
	public function __construct($payloadData = []) {
		if(isset($payloadData['endpoints'])) {
			$this->setEndpoints($payloadData['endpoints']);
		}
	}


	/**
     * @return  array
     */
    public function getEndpoints() {
        return $this->endpoints;
    }

    /**
     * @param   array $endpoints
     * @return  Payload
     */
    public function setEndpoints($endpoints) {
        $this->endpoints = $endpoints;
        return $this;
    }

    /**
     * @param   $endpoint
     * @return  Payload
     */
    public function addEndpoint($endpoint) {
        array_push($this->endpoints, $endpoint);
        return $this;
    }


    /**
     * @return  array
     */
    function render() {
        $rendered = [];

        // Endpoints
        if(count($this->endpoints)) {
            $rendered['endpoints'] = $this->getEndpoints();
        }

        return $rendered;
    }
}
