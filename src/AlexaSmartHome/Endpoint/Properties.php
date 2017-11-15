<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint;

/**
 * Class Properties
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Properties {
	/** @var array $supported */
	protected $supported = [];

	/** @var bool $proactivelyReported */
	protected $proactivelyReported = false;

	/** @var bool $retrievable */
	protected $retrievable = false;


	/**
	 * @param array $properties
	 * @param bool $proactivelyReported
	 * @param bool $retrievable
	 */
	public function __construct($properties = [], $proactivelyReported = false, $retrievable = false) {
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
	 */
	public function addSupported($name) {
        array_push($this->supported, ['name' => $name]);

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
