<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Response;

/**
 * Class Context
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Context {
    /** @var array $properties */
    protected $properties = [];


	/**
	 * @param array $properties
	 */
	public function __construct($properties = []) {
		$this->setProperties($properties);
	}


	/**
	 * @return array
	 */
	public function getProperties() {
		return $this->properties;
	}

	/**
	 * @param array $properties
	 *
	 * @return Context
	 */
	public function setProperties($properties) {
		foreach($properties as $property) {
			$this->addProperty($property);
		}

		return $this;
	}

	/**
	 * @param mixed $property
	 *
	 * @return Context
	 */
	public function addProperty($property) {
		array_push($this->properties, $property);

		return $this;
	}


    /**
     * @return  array
     */
    function render() {
	    $rendered = [];

	    if(count($this->getProperties())) {
		    $renderedProperties = [];
		    foreach($this->getProperties() as $property) {
			    // array_push($renderedProperties, $property->render());
			    array_push($renderedProperties, $property);
		    }

		    $rendered['properties'] = $renderedProperties;
	    }

	    return $rendered;
    }
}

