<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event\Payload\Endpoint\Capability;

use \InvalidArgumentException;

/**
 * Class Properties
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Properties {
	/** @var array $validSupportedProperties */
	protected $validSupportedProperties = [];

	/** @var array $supported */
	protected $supported = [];

	/** @var bool $proactivelyReported */
	protected $proactivelyReported = false;

	/** @var bool $retrievable */
	protected $retrievable = false;


	/**
	 * @param array $validSupportedProperties
	 */
	public function __construct(
		$validSupportedProperties = [],
		$properties = [],
		$proactivelyReported = false,
		$retrievable = false
	) {
		$this->validSupportedProperties = $validSupportedProperties;
		$this->setSupported($properties);
		$this->setProactivelyReported($proactivelyReported);
		$this->setRetrievable($retrievable);
	}


	/**
	 * @return array
	 */
	public function getSupported() {
		return $this->supported;
	}

	/**
	 * @param array $supported
	 *
	 * @return Properties
	 */
	public function setSupported($supported) {
		foreach($supported as $property) {
			$this->addSupported($property);
		}

		return $this;
	}

	/**
	 * @param string $name
	 *
	 * @return Properties
	 *
	 * @throws InvalidArgumentException
	 */
	public function addSupported($name) {
		if(in_array($name, $this->validSupportedProperties)) {
			array_push($this->supported, ['name' => $name]);
		} else {
			throw new InvalidArgumentException('Unsupported property name: ' . $name . ' (supported: ' . implode(', ', $this->validSupportedProperties) . ')');
		}

		return $this;
	}


	/**
	 * @return bool
	 */
	public function isProactivelyReported() {
		return $this->proactivelyReported;
	}

	/**
	 * @param bool $proactivelyReported
	 *
	 * @return Properties
	 */
	public function setProactivelyReported($proactivelyReported) {
		$this->proactivelyReported = $proactivelyReported;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isRetrievable() {
		return $this->retrievable;
	}

	/**
	 * @param bool $retrievable
	 *
	 * @return Properties
	 */
	public function setRetrievable($retrievable) {
		$this->retrievable = $retrievable;

		return $this;
	}

	/**
	 * @return array
	 */
	public function render() {
		$rendered = [
			'supported' => $this->getSupported(),
			'proactivelyReported' => $this->isProactivelyReported(),
			'retrievable' => $this->isRetrievable(),
		];

		return $rendered;
	}
}
