<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Response;

/**
 * Class Context
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 * @TODO    Consider replacing $this->data with stronger typed objects
 */
class Context {
    /** @var array $data */
    protected $data;


	/**
	 * @param array $contextData
	 */
	public function __construct($contextData = []) {
		$this->setData($contextData);
	}


	/**
     * @return  array
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @param   array $data
     * @return  Context
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }


    /**
     * @return  array
     */
    function render() {
        $rendered = $this->getData();

        return $rendered;
    }
}

