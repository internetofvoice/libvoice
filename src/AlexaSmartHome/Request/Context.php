<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Request;

/**
 * Class Context
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Context {
    /** @var array $data */
    protected $data;


	/**
	 * @param array $contextData
	 */
	public function __construct(array $contextData) {
	    $this->data = $contextData;
	}


    /**
     * @return array
     */
    public function getData(): array {
        return $this->data;
    }
}

