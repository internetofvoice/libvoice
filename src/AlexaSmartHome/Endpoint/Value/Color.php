<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value;

use \InvalidArgumentException;

/**
 * Class Color
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Color {
    /** @var float $hue */
    protected $hue = 0.0;

    /** @var float $saturation */
    protected $saturation = 0.0;

    /** @var float $brightness */
    protected $brightness = 0.0;

    /**
     * @param float $hue
     * @param float $saturation
     * @param float $brightness
     */
    public function __construct($hue, $saturation, $brightness) {
        $this->setHue($hue);
        $this->setSaturation($saturation);
        $this->setBrightness($brightness);
    }

    /**
     * @return Color
     */
    public static function create(): Color {
        return new Color(0.0, 0.0, 0.0);
    }

	/**
	 * @param  array $data
	 *
	 * @return Color
	 *
	 * @throws InvalidArgumentException
	 */
	public static function createFromArray(array $data): Color {
		$hue        = isset($data['hue']) ? floatval($data['hue']) : -1.0;
		$saturation = isset($data['saturation']) ? floatval($data['saturation']) : -1.0;
		$brightness = isset($data['brightness']) ? floatval($data['brightness']) : -1.0;

		if($hue === -1.0 or $saturation === -1.0 or $brightness === -1.0) {
			throw new InvalidArgumentException('Hue, Saturation and Brightness must be given.');
		}

		return new Color($hue, $saturation, $brightness);
	}


    /**
     * @return float
     */
    public function getHue(): float {
        return $this->hue;
    }

    /**
     * @param  float $hue
     *
     * @return Color
     *
     * @throws InvalidArgumentException
     */
    public function setHue(float $hue): Color {
        if($hue < 0.0 or $hue > 360.0) {
            throw new InvalidArgumentException('Hue must be a float between 0.0 and 360.0 (inclusive).');
        }

        $this->hue = $hue;

        return $this;
    }

    /**
     * @return float
     */
    public function getSaturation(): float {
        return $this->saturation;
    }

    /**
     * @param  float $saturation
     *
     * @return Color
     *
     * @throws InvalidArgumentException
     */
    public function setSaturation(float $saturation): Color {
        if($saturation < 0.0 or $saturation > 1.0) {
            throw new InvalidArgumentException('Saturation must be a float between 0.0 and 1.0 (inclusive).');
        }

        $this->saturation = $saturation;

        return $this;
    }

    /**
     * @return float
     */
    public function getBrightness(): float {
        return $this->brightness;
    }

    /**
     * @param  float $brightness
     *
     * @return Color
     *
     * @throws InvalidArgumentException
     */
    public function setBrightness(float $brightness): Color {
        if($brightness < 0.0 or $brightness > 1.0) {
            throw new InvalidArgumentException('Brightness must be a float between 0.0 and 1.0 (inclusive).');
        }

        $this->brightness = $brightness;

        return $this;
    }

	/**
	 * @return array
	 */
	public function render(): array {
        return [
	        'hue'        => $this->getHue(),
	        'saturation' => $this->getSaturation(),
	        'brightness' => $this->getBrightness(),
        ];
	}
}
