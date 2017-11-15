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
    protected $version;

    /** @var Properties $properties */
    protected $properties;

    /** @var array $extraProperties */
    protected $extraProperties;


    /**
     * Capability constructor
     *
     * @param string $interface
     * @param array  $properties
     * @param bool   $proactivelyReported
     * @param bool   $retrievable
     * @param array  $extraProperties
     * @throws InvalidArgumentException
     */
    public function __construct(
        $interface,
        $properties = [],
        $proactivelyReported = false,
        $retrievable = false,
        $extraProperties = null
    ) {
        if(!$this->isInterfaceAvailable($interface)) {
            throw new InvalidArgumentException('Unknown interface: ' . $interface);
        }

        $this->setInterface($interface);
        $this->setVersion($this->getApiVersion());

        if(is_array($properties) && count($properties)) {
            $valid = $this->getPropertiesFor($interface);
            foreach($properties as $property) {
                if(!isset($valid[$property])) {
                    throw new InvalidArgumentException('Invalid property ' . $property . ' for interface: ' . $interface);
                }
            }

            $this->properties = new Properties($properties, $proactivelyReported, $retrievable);
        }

        if(is_array($extraProperties) && count($extraProperties)) {
            $valid = $this->getExtraPropertiesFor($interface);
            foreach($extraProperties as $key => $value) {
                if(!isset($valid[$key])) {
                    throw new InvalidArgumentException('Invalid extra property ' . $key . ' for interface: ' . $interface);
                }

                $this->addExtraProperty($key, $value);
            }
        }
    }


    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Capability
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getInterface() {
        return $this->interface;
    }

    /**
     * @param string $interface
     * @return Capability
     */
    public function setInterface($interface) {
        $this->interface = $interface;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion() {
        return $this->version;
    }

    /**
     * @param string $version
     * @return Capability
     */
    public function setVersion($version) {
        $this->version = $version;
        return $this;
    }

    /**
     * @return Properties
     */
    public function getProperties() {
        return $this->properties;
    }

    /**
     * @param Properties $properties
     * @return Capability
     */
    public function setProperties($properties) {
        $this->properties = $properties;
        return $this;
    }

    /**
     * @return array
     */
    public function getExtraProperties() {
        return $this->extraProperties;
    }

    /**
     * @param array $extraProperties
     * @return Capability
     */
    public function setExtraProperties($extraProperties) {
        foreach($extraProperties as $key => $value) {
            $this->addExtraProperty($key, $value);
        }

        return $this;
    }

    /**
     * @param   string $key
     * @param   mixed $value
     * @return  Capability
     */
    public function addExtraProperty($key, $value) {
        if(is_null($this->extraProperties))  {
            $this->extraProperties = [];
        }

        $this->extraProperties[$key] = $value;
        return $this;
    }


    /**
     * @return array
     */
    public function render() {
        $rendered = [
            'type' => $this->getType(),
            'interface' => $this->getInterface(),
            'version' => $this->getVersion(),
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
