<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint;

/**
 * Class DiscoverableProperties
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class DiscoverableProperties {
	/** @var array $supported */
	protected $supported = [];

	/** @var bool $proactivelyReported */
	protected $proactivelyReported = false;

	/** @var bool $retrievable */
	protected $retrievable = false;


	/**
	 * @param array $properties
	 * @param bool  $proactivelyReported
	 * @param bool  $retrievable
	 */
	public function __construct(array $properties = [], bool $proactivelyReported = false, bool $retrievable = false) {
		$this->setSupported($properties);
		$this->setProactivelyReported($proactivelyReported);
		$this->setRetrievable($retrievable);
	}


	/**
	 * @return array
	 */
	public function getSupported(): array {
		return $this->supported;
	}

	/**
	 * @param  array $supported
	 *
	 * @return DiscoverableProperties
	 */
	public function setSupported(array $supported): DiscoverableProperties {
		foreach($supported as $property) {
			$this->addSupported($property);
		}

		return $this;
	}

	/**
	 * @param  string $name
	 *
	 * @return DiscoverableProperties
	 */
	public function addSupported(string $name): DiscoverableProperties {
        array_push($this->supported, ['name' => $name]);

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isProactivelyReported(): bool {
		return $this->proactivelyReported;
	}

	/**
	 * @param  bool $proactivelyReported
	 *
	 * @return DiscoverableProperties
	 */
	public function setProactivelyReported(bool $proactivelyReported): DiscoverableProperties {
		$this->proactivelyReported = $proactivelyReported;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isRetrievable(): bool {
		return $this->retrievable;
	}

	/**
	 * @param  bool $retrievable
	 *
	 * @return DiscoverableProperties
	 */
	public function setRetrievable(bool $retrievable): DiscoverableProperties {
		$this->retrievable = $retrievable;

		return $this;
	}

	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'supported'           => $this->getSupported(),
			'proactivelyReported' => $this->isProactivelyReported(),
			'retrievable'         => $this->isRetrievable(),
		];
	}
}
