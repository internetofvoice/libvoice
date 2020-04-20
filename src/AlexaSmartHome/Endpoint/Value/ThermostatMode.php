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
    protected $value = '';

    /** @var string $customName */
    protected $customName = '';


    /**
     * @param string $value
     * @param string $customName
     */
    public function __construct(string $value, string $customName = '') {
        $this->setValue($value);
        $this->setCustomName($customName);
    }

	/**
	 * @param  array $data
	 *
	 * @return ThermostatMode
	 *
	 * @throws InvalidArgumentException
	 */
	public static function createFromArray(array $data): ThermostatMode {
		$value      = isset($data['value']) ? $data['value'] : '';
		$customName = isset($data['customName']) ? $data['customName'] : '';

		return new ThermostatMode($value, $customName);
	}


	/**
	 * @return string
	 */
	public function getValue(): string {
		return $this->value;
	}

	/**
	 * @param  string $value
	 *
	 * @return ThermostatMode
	 *
	 * @throws InvalidArgumentException
	 */
	public function setValue(string $value): ThermostatMode {
		if(!in_array($value, self::VALID_VALUES)) {
			throw new InvalidArgumentException('Value must be one of: ' . implode(', ', self::VALID_VALUES));

		}

		$this->value = $value;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getCustomName(): string {
		return $this->customName;
	}

	/**
	 * @param  string $customName
	 *
	 * @return ThermostatMode
	 */
	public function setCustomName(string $customName): ThermostatMode {
		$this->customName = $customName;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
        $rendered = [
        	'value' => $this->getValue()
        ];

        if($this->getCustomName()) {
	        $rendered['customName'] = $this->getCustomName();
        }

        return $rendered;
	}
}
