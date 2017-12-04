<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value;

use \InvalidArgumentException;

/**
 * Class ThermostatMode
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ThermostatMode {
	/** @var array VALID_VALUES */
	const VALID_VALUES = ['AUTO', 'COOL', 'HEAT', 'ECO', 'OFF', 'CUSTOM'];

    /** @var string $value */
    protected $value;

    /** @var string $customName */
    protected $customName;


    /**
     * @param string $value
     * @param string $customName
     */
    public function __construct($value = null, $customName = null) {
        $this->setValue($value);
        $this->setCustomName($customName);
    }

	/**
	 * @param  array $data
	 * @return ThermostatMode
	 * @throws InvalidArgumentException
	 */
	public static function createFromArray($data) {
		$value = isset($data['value']) ? $data['value'] : null;
		$customName = isset($data['customName']) ? $data['customName'] : null;

		return new ThermostatMode($value, $customName);
	}


	/**
	 * @return string
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param string $value
	 *
	 * @return ThermostatMode
	 *
	 * @throws InvalidArgumentException
	 */
	public function setValue($value) {
		if(!in_array($value, self::VALID_VALUES)) {
			throw new InvalidArgumentException('Value is not valid.');
		}

		$this->value = $value;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCustomName() {
		return $this->customName;
	}

	/**
	 * @param string $customName
	 *
	 * @return ThermostatMode
	 */
	public function setCustomName($customName) {
		$this->customName = $customName;

		return $this;
	}


	/**
	 * @return array
     * @throws InvalidArgumentException
	 */
	public function render() {
        $rendered = [
        	'value' => $this->getValue()
        ];

        if($this->getCustomName()) {
	        $rendered['customName'] = $this->getCustomName();
        }

        return $rendered;
	}
}
