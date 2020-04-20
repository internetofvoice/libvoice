<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint;

use \InvalidArgumentException;

/**
 * Class Capability
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */

class Capability extends Relation {
    /** @var string $type */
    protected $type = 'AlexaInterface';

    /** @var string $interface */
    protected $interface = '';

    /** @var string $version */
    protected $version = '';

    /** @var DiscoverableProperties $properties */
    protected $properties;

    /** @var array $extraProperties */
    protected $extraProperties = [];


    /**
     * Capability constructor
     *
     * @param  string $interface
     * @param  array  $properties
     * @param  bool   $proactivelyReported
     * @param  bool   $retrievable
     * @param  array  $extraProperties
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $interface, array $properties = [], bool $proactivelyReported = false, bool $retrievable = false, array $extraProperties = []) {
        $this->setInterface($interface);
        $this->setVersion($this->getApiVersion());
        $this->setProperties($properties, $proactivelyReported, $retrievable);
        $this->setExtraProperties($extraProperties);
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
     * @return Capability
     */
    public function setType(string $type): Capability {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getInterface(): string {
        return $this->interface;
    }

    /**
     * @param  string $interface
     *
     * @return Capability
     * @throws InvalidArgumentException
     */
    public function setInterface(string $interface): Capability {
        if(!$this->isInterfaceAvailable($interface)) {
            throw new InvalidArgumentException('Unknown interface: ' . $interface);
        }

        $this->interface = $interface;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string {
        return $this->version;
    }

    /**
     * @param  string $version
     *
     * @return Capability
     */
    public function setVersion(string $version): Capability {
        $this->version = $version;
        return $this;
    }

    /**
     * @return null|DiscoverableProperties
     */
    public function getProperties(): ?DiscoverableProperties {
        return $this->properties;
    }

    /**
     * @param  array $properties
     * @param  bool  $proactivelyReported
     * @param  bool  $retrievable
     *
     * @return Capability
     * @throws InvalidArgumentException
     */
    public function setProperties(array $properties, bool $proactivelyReported, bool $retrievable) {
        $interface = $this->getInterface();

        if(is_array($properties) && count($properties)) {
            $valid = $this->getPropertiesFor($interface);
            foreach($properties as $property) {
                if(!array_key_exists($property, $valid)) {
                    throw new InvalidArgumentException('Invalid property ' . $property . ' for interface: ' . $interface);
                }
            }

            $this->properties = new DiscoverableProperties($properties, $proactivelyReported, $retrievable);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getExtraProperties(): array {
        return $this->extraProperties;
    }

    /**
     * @param  array $extraProperties
     *
     * @return Capability
     */
    public function setExtraProperties(array $extraProperties): Capability {
        if(is_array($extraProperties) && count($extraProperties)) {
            foreach($extraProperties as $key => $value) {
                $this->addExtraProperty($key, $value);
            }
        }

        return $this;
    }

    /**
     * @param  string $key
     * @param  mixed  $value
     *
     * @return Capability
     * @throws InvalidArgumentException
     */
    public function addExtraProperty(string $key, $value): Capability {
	    $interface = $this->getInterface();
	    $valid     = $this->getExtraPropertiesFor($interface);
        if(!array_key_exists($key, $valid)) {
            throw new InvalidArgumentException('Invalid extra property ' . $key . ' for interface: ' . $interface);
        }

        $this->extraProperties[$key] = $value;

        return $this;
    }


    /**
     * @return array
     */
    public function render(): array {
        $rendered = [
	        'type'      => $this->getType(),
	        'interface' => $this->getInterface(),
	        'version'   => $this->getVersion(),
        ];

        if(!is_null($this->getProperties())) {
            $rendered['properties'] = $this->getProperties()->render();
        }

        if(count($this->getExtraProperties())) {
            foreach($this->getExtraProperties() as $key => $value) {
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
        }

        return $rendered;
    }
}
