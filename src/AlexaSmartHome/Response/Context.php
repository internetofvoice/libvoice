<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Response;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\ReportableProperty;

/**
 * Class Context
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Context {
    /** @var ReportableProperty[] $properties */
    protected $properties = [];


	/**
	 * @param ReportableProperty[] $properties
	 */
	public function __construct(array $properties = []) {
		$this->setProperties($properties);
	}


	/**
	 * @return ReportableProperty[]
	 */
	public function getProperties(): array {
		return $this->properties;
	}

	/**
	 * @param  ReportableProperty[] $properties
	 *
	 * @return Context
	 */
	public function setProperties(array $properties): Context {
		foreach($properties as $property) {
			$this->addProperty($property);
		}

		return $this;
	}

	/**
 	 * @param  ReportableProperty $property
	 *
	 * @return Context
	 */
	public function addProperty(ReportableProperty $property): Context {
		array_push($this->properties, $property);

		return $this;
	}


    /**
     * @return array
     */
    function render(): array {
	    $rendered = [];

	    if(count($this->getProperties())) {
		    $renderedProperties = [];
		    foreach($this->getProperties() as $property) {
				array_push($renderedProperties, $property->render());
		    }

		    $rendered['properties'] = $renderedProperties;
	    }

	    return $rendered;
    }
}

