<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event\Payload;

use \InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event\Payload\Endpoint\Capability\AbstractCapability;
use \InvalidArgumentException;

/**
 * Class Endpoint
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Endpoint {
	/** @var string $endpointId */
	protected $endpointId;

	/** @var string $manufacturerName */
	protected $manufacturerName;

	/** @var string $friendlyName */
	protected $friendlyName;

	/** @var string $description */
	protected $description;

	/** @var array $displayCategories */
	protected $displayCategories = [];

	/** @var array validDisplayCategories */
	const validDisplayCategories = [
		'ACTIVITY_TRIGGER',
		'CAMERA',
		'DOOR',
		'LIGHT',
		'OTHER',
		'SCENE_TRIGGER',
		'SMARTLOCK',
		'SMARTPLUG',
		'SPEAKERS',
		'SWITCH',
		'TEMPERATURE_SENSOR',
		'THERMOSTAT',
		'TV',
	];

	/**
	 * @var array $cookie
	 *
	 * this is a somewhat misleading identifier in Amazons API (it is in fact an array of cookies).
	 * however, we keep it for the sake of consistency. However, the method names are more meaningful,
	 * for example getCookie() vs. getCookies()
	 */
	protected $cookie = [];

	/** @var AbstractCapability[] $capabilities */
	protected $capabilities = [];


	/**
	 * @param array $endpointData
	 */
	public function __construct($endpointData = []) {
		if(isset($endpointData['endpointId'])) {
			$this->setEndpointId($endpointData['endpointId']);
		}

		if(isset($endpointData['manufacturerName'])) {
			$this->setManufacturerName($endpointData['manufacturerName']);
		}

		if(isset($endpointData['friendlyName'])) {
			$this->setFriendlyName($endpointData['friendlyName']);
		}

		if(isset($endpointData['description'])) {
			$this->setDescription($endpointData['description']);
		}

		if(isset($endpointData['displayCategories'])) {
			$this->setDisplayCategories($endpointData['displayCategories']);
		}

		if(isset($endpointData['cookie'])) {
			$this->setCookies($endpointData['cookie']);
		}

		if(isset($endpointData['capabilities'])) {
			$this->setCapabilities($endpointData['capabilities']);
		}
	}


	/**
	 * @return string
	 */
	public function getEndpointId() {
		return $this->endpointId;
	}

	/**
	 * @param string $endpointId
	 *
	 * @return Endpoint
	 */
	public function setEndpointId($endpointId) {
		$this->endpointId = $endpointId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getManufacturerName() {
		return $this->manufacturerName;
	}

	/**
	 * @param string $manufacturerName
	 *
	 * @return Endpoint
	 */
	public function setManufacturerName($manufacturerName) {
		$this->manufacturerName = $manufacturerName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFriendlyName() {
		return $this->friendlyName;
	}

	/**
	 * @param string $friendlyName
	 *
	 * @return Endpoint
	 */
	public function setFriendlyName($friendlyName) {
		$this->friendlyName = $friendlyName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param string $description
	 *
	 * @return Endpoint
	 */
	public function setDescription($description) {
		$this->description = $description;

		return $this;
	}


	/**
	 * @return array
	 */
	public function getDisplayCategories() {
		return $this->displayCategories;
	}

	/**
	 * @param array $displayCategories
	 *
	 * @return Endpoint
	 */
	public function setDisplayCategories($displayCategories) {
		$this->displayCategories = [];

		foreach ($displayCategories as $displayCategory) {
			$this->addDisplayCategory($displayCategory);
		}

		return $this;
	}

	/**
	 * @param string $displayCategory
	 *
	 * @return Endpoint
	 *
	 * @throws InvalidArgumentException
	 */
	public function addDisplayCategory($displayCategory) {
		if(in_array($displayCategory, self::validDisplayCategories)) {
			array_push($this->displayCategories, $displayCategory);
		} else {
			throw new InvalidArgumentException('Invalid display category: ' . $displayCategory);
		}

		return $this;
	}


	/**
	 * @return array
	 */
	public function getCookies() {
		return $this->cookie;
	}

	/**
	 * @param array $cookies
	 *
	 * @return Endpoint
	 */
	public function setCookies($cookies) {
		$this->cookie = $cookies;

		return $this;
	}

	/**
	 * @param string $key
	 * @param mixed  $default
	 *
	 * @return  mixed
	 */
	public function getCookie($key, $default = null) {
		return isset($this->cookie[$key]) ? $this->cookie[$key] : $default;
	}

	/**
	 * @param string $key
	 * @param mixed $value
	 *
	 * @return Endpoint
	 */
	public function setCookie($key, $value) {
		$this->cookie[$key] = $value;

		return $this;
	}


	/**
	 * @return AbstractCapability[]
	 */
	public function getCapabilities() {
		return $this->capabilities;
	}

	/**
	 * @param AbstractCapability[] $capabilities
	 *
	 * @return Endpoint
	 */
	public function setCapabilities($capabilities) {
		$this->capabilities = $capabilities;

		return $this;
	}


    /**
     * @return  array
     */
    function render() {
        $rendered = [
	        'endpointId' => $this->getEndpointId(),
		    'manufacturerName' => $this->getManufacturerName(),
		    'friendlyName' => $this->getFriendlyName(),
		    'description' => $this->getDescription(),
        ];

        if(count($this->displayCategories)) {
            $rendered['displayCategories'] = $this->getDisplayCategories();
        }

	    if(count($this->cookie)) {
		    $rendered['cookie'] = $this->getCookies();
	    }

	    if(count($this->capabilities)) {
        	$renderedCapabilities = array();
        	foreach($this->getCapabilities() as $capability) {
        		array_push($renderedCapabilities, $capability->render());
	        }

		    $rendered['capabilities'] = $renderedCapabilities;
	    }

        return $rendered;
    }
}
