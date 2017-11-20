<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value;

use \InvalidArgumentException;

/**
 * Class Temperature
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Temperature {
    /** @var float $value */
    protected $value;

    /** @var array validScales */
    const validScales = ['CELSIUS', 'FAHRENHEIT', 'KELVIN'];

    /** @var string $scale */
    protected $scale;


    /**
     * @param float  $value
     * @param string $scale
     */
    public function __construct($value = null, $scale = null) {
        $this->setValue($value);
        $this->setScale($scale);
    }

    /**
     * @return Temperature()
     */
    public static function create() {
        return new Temperature();
    }

	/**
	 * @param  array $data
	 * @return Temperature
	 * @throws InvalidArgumentException
	 */
	public static function createFromArray($data) {
		$value = isset($data['value']) ? $data['value'] : null;
		$scale = isset($data['scale']) ? $data['scale'] : null;

		if(is_null($value) or is_null($scale)) {
			throw new InvalidArgumentException('Value and Scale are required.');
		}

		return new Temperature($value, $scale);
	}


    /**
     * @return float
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param  float $value
     * @return Temperature
     */
    public function setValue($value) {
        $this->value = floatval($value);
        return $this;
    }

    /**
     * @return string
     */
    public function getScale() {
        return $this->scale;
    }

    /**
     * @param  string $scale
     * @return Temperature
     * @throws InvalidArgumentException
     */
    public function setScale($scale) {
        if(!is_null($scale) && !in_array($scale, self::validScales)) {
            throw new InvalidArgumentException('Scale must be one of: ' . implode(', ', self::validScales));
        }

        $this->scale = $scale;
        return $this;
    }


	/**
	 * @return array
     * @throws InvalidArgumentException
	 */
	public function render() {
	    $value = $this->getValue();
	    $scale = $this->getScale();

        if(is_null($value) or is_null($scale)) {
            throw new InvalidArgumentException('Value and Scale are required.');
        }

        $rendered = [
            'value' => $value,
            'scale' => $scale,
        ];

        return $rendered;
	}
}
