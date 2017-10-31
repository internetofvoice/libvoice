<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event\Payload\Endpoint\Capability;

/**
 * Abstract Class AbstractCapability
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
abstract class AbstractCapability {
	/** @var string $type */
	protected $type;

	/** @var string $interface */
	protected $interface;

	/** @var string $version */
	protected $version;

	/** @var Properties $properties */
	protected $properties;


	public function __construct() {
	}


	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param string $type
	 *
	 * @return AbstractCapability
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
	 *
	 * @return AbstractCapability
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
	 *
	 * @return AbstractCapability
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
	 *
	 * @return AbstractCapability
	 */
	public function setProperties($properties) {
		$this->properties = $properties;

		return $this;
	}


	/**
	 * @return array
	 */
	abstract function render();
}
