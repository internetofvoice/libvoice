<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value;

use \InvalidArgumentException;

/**
 * Class Cause
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Cause {
	/** @var array VALID_TYPES */
	const VALID_TYPES = [
		'APP_INTERACTION',
		'PHYSICAL_INTERACTION',
		'PERIODIC_POLL',
		'RULE_TRIGGER',
		'VOICE_INTERACTION'
	];

	/** @var string $type */
	protected $type;


	/**
	 * @param string $type
	 */
	public function __construct($type) {
		$this->setType($type);
	}


	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param  string $type
	 *
	 * @return Cause
	 *
	 * @throws InvalidArgumentException
	 */
	public function setType($type) {
		if(!in_array($type, self::VALID_TYPES)) {
			throw new InvalidArgumentException('Invalid cause type.');
		}

		$this->type = $type;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		return [
			'type' => $this->getType(),
		];
	}
}
