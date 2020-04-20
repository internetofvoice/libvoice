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
    protected $value = 0.0;

    /** @var array validScales */
    const validScales = ['CELSIUS', 'FAHRENHEIT', 'KELVIN'];

    /** @var string $scale */
    protected $scale = '';


    /**
     * @param float  $value
     * @param string $scale
     */
    public function __construct(float $value, string $scale) {
        $this->setValue($value);
        $this->setScale($scale);
    }

    /**
     * @return Temperature()
     */
    public static function create(): Temperature {
        return new Temperature(0, 'CELSIUS');
    }

	/**
	 * @param  array $data
	 *
	 * @return Temperature
	 *
	 * @throws InvalidArgumentException
	 */
	public static function createFromArray(array $data): Temperature {
		$value = isset($data['value']) ? $data['value'] : 0.0;
		$scale = isset($data['scale']) ? $data['scale'] : '';

		if(!$value or !$scale) {
			throw new InvalidArgumentException('Value and Scale are required.');
		}

		return new Temperature($value, $scale);
	}


    /**
     * @return float
     */
    public function getValue(): float {
        return $this->value;
    }

    /**
     * @param  float $value
     *
     * @return Temperature
     */
    public function setValue(float $value): Temperature {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getScale(): string {
        return $this->scale;
    }

    /**
     * @param  string $scale
     *
     * @return Temperature
     *
     * @throws InvalidArgumentException
     */
    public function setScale(string $scale): Temperature {
        if(!in_array($scale, self::validScales)) {
            throw new InvalidArgumentException('Scale must be one of: ' . implode(', ', self::validScales));
        }

        $this->scale = $scale;

        return $this;
    }


	/**
	 * @return array
	 */
	public function render(): array {
        return [
            'value' => $this->getValue(),
            'scale' => $this->getScale(),
        ];
	}
}
