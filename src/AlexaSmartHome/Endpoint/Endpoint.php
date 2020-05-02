<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Scope\Scope;
use \InvalidArgumentException;

/**
 * Class Endpoint
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Endpoint {
	/** @var string $endpointId */
	protected $endpointId = '';

	/** @var string $manufacturerName */
	protected $manufacturerName= '';

	/** @var string $friendlyName */
	protected $friendlyName= '';

	/** @var string $description */
	protected $description= '';

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
	 * however, we keep it for the sake of consistency. The method names in turn are more consistent,
	 * for example getCookie() for a single cookie and getCookies() for an array of cookies.
	 */
	protected $cookie = [];

	/** @var Capability[] $capabilities */
	protected $capabilities = [];

	/** @var Scope $scope */
	protected $scope;


	/**
	 * @param array $endpointData
	 */
	public function __construct(array $endpointData = []) {
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

		if(isset($endpointData['scope'])) {
			$this->setScope(new Scope($endpointData['scope']));
		}
	}

	/**
	 * @return Endpoint
	 */
	public static function create(): Endpoint {
		return new Endpoint();
	}


	/**
	 * @return string
	 */
	public function getEndpointId(): string {
		return $this->endpointId;
	}

	/**
	 * @param  string $endpointId
	 *
	 * @return Endpoint
	 */
	public function setEndpointId(string $endpointId): Endpoint {
		$this->endpointId = $endpointId;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getManufacturerName(): string {
		return $this->manufacturerName;
	}

	/**
	 * @param  string $manufacturerName
	 *
	 * @return Endpoint
	 */
	public function setManufacturerName(string $manufacturerName): Endpoint  {
		$this->manufacturerName = $manufacturerName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFriendlyName(): string {
		return $this->friendlyName;
	}

	/**
	 * @param  string $friendlyName
	 *
	 * @return Endpoint
	 */
	public function setFriendlyName(string $friendlyName): Endpoint  {
		$this->friendlyName = $friendlyName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription(): string {
		return $this->description;
	}

	/**
	 * @param  string $description
	 *
	 * @return Endpoint
	 */
	public function setDescription(string $description): Endpoint  {
		$this->description = $description;

		return $this;
	}


	/**
	 * @return array
	 */
	public function getDisplayCategories(): array {
		return $this->displayCategories;
	}

	/**
	 * @param  array $displayCategories
	 *
	 * @return Endpoint
	 */
	public function setDisplayCategories(array $displayCategories): Endpoint  {
		$this->displayCategories = [];

		foreach ($displayCategories as $displayCategory) {
			$this->addDisplayCategory($displayCategory);
		}

		return $this;
	}

	/**
	 * @param  string $displayCategory
	 *
	 * @return Endpoint
	 * @throws InvalidArgumentException
	 */
	public function addDisplayCategory(string $displayCategory): Endpoint  {
		if(!in_array($displayCategory, self::validDisplayCategories)) {
			throw new InvalidArgumentException('Invalid display category: ' . $displayCategory);
		}

		array_push($this->displayCategories, $displayCategory);

		return $this;
	}

	/**
	 * @return array
	 */
	public function getCookies(): array {
		return $this->cookie;
	}

	/**
	 * @param  array $cookies
	 *
	 * @return Endpoint
	 */
	public function setCookies(array $cookies): Endpoint {
		$this->cookie = $cookies;

		return $this;
	}

	/**
	 * @param  string $key
	 * @param  mixed  $default
	 *
	 * @return mixed
	 */
	public function getCookie(string $key, $default = null) {
		return isset($this->cookie[$key]) ? $this->cookie[$key] : $default;
	}

	/**
	 * @param  string $key
	 * @param  mixed $value
	 *
	 * @return Endpoint
	 */
	public function setCookie(string $key, $value): Endpoint {
		$this->cookie[$key] = $value;

		return $this;
	}


	/**
	 * @return Capability[]
	 */
	public function getCapabilities(): array {
		return $this->capabilities;
	}

	/**
	 * @param  Capability[] $capabilities
	 *
	 * @return Endpoint
	 */
	public function setCapabilities(array $capabilities): Endpoint {
		$this->capabilities = $capabilities;

		return $this;
	}

	/**
	 * @return null|Scope
	 */
	public function getScope(): ?Scope {
		return $this->scope;
	}

	/**
	 * @param  Scope $scope
	 *
	 * @return Endpoint
	 */
	public function setScope(Scope $scope): Endpoint {
		$this->scope = $scope;

		return $this;
	}


    /**
     * @return  array
     */
    function render() {
        $rendered = [
	        'endpointId' => $this->getEndpointId(),
        ];

        if($this->getManufacturerName()) {
            $rendered['manufacturerName'] = $this->getManufacturerName();
        }

        if($this->getFriendlyName()) {
            $rendered['friendlyName'] = $this->getFriendlyName();
        }

        if($this->getDescription()) {
            $rendered['description'] = $this->getDescription();
        }

        if(count($this->getDisplayCategories())) {
            $rendered['displayCategories'] = $this->getDisplayCategories();
        }

	    if(count($this->getCookies())) {
		    $rendered['cookie'] = $this->getCookies();
	    }

        if(count($this->getCapabilities())) {
            $renderedCapabilities = array();
            foreach($this->getCapabilities() as $capability) {
                array_push($renderedCapabilities, $capability->render());
            }

            $rendered['capabilities'] = $renderedCapabilities;
        }

        if(!is_null($this->getScope())) {
            $rendered['scope'] = $this->getScope()->render();
        }

        return $rendered;
    }
}
