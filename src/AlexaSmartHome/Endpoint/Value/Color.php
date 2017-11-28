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
    protected $hue;

    /** @var float $saturation */
    protected $saturation;

    /** @var float $brightness */
    protected $brightness;

    /**
     * @param float $hue
     * @param float $saturation
     * @param float $brightness
     */
    public function __construct($hue = null, $saturation = null, $brightness = null) {
        $this->setHue($hue);
        $this->setSaturation($saturation);
        $this->setBrightness($brightness);
    }

    /**
     * @return Color
     */
    public static function create() {
        return new Color();
    }

	/**
	 * @param  array $data
	 * @return Color
	 * @throws InvalidArgumentException
	 */
	public static function createFromArray($data) {
		$hue = isset($data['hue']) ? $data['hue'] : null;
		$saturation = isset($data['saturation']) ? $data['saturation'] : null;
		$brightness = isset($data['brightness']) ? $data['brightness'] : null;

		if(is_null($hue) or is_null($saturation) or is_null($brightness)) {
			throw new InvalidArgumentException('Hue, Saturation and Brightness must be given.');
		}

		return new Color($hue, $saturation, $brightness);
	}


    /**
     * @return float
     */
    public function getHue() {
        return $this->hue;
    }

    /**
     * @param  float $hue
     * @return Color
     * @throws InvalidArgumentException
     */
    public function setHue($hue) {
        $hue = floatval($hue);
        if($hue < 0.0 or $hue > 360.0) {
            throw new InvalidArgumentException('Hue must be a float between 0.0 and 360.0 (inclusive).');
        }

        $this->hue = $hue;
        return $this;
    }

    /**
     * @return float
     */
    public function getSaturation() {
        return $this->saturation;
    }

    /**
     * @param  float $saturation
     * @return Color
     * @throws InvalidArgumentException
     */
    public function setSaturation($saturation) {
        $saturation = floatval($saturation);
        if($saturation < 0.0 or $saturation > 1.0) {
            throw new InvalidArgumentException('Saturation must be a float between 0.0 and 1.0 (inclusive).');
        }

        $this->saturation = $saturation;
        return $this;
    }

    /**
     * @return float
     */
    public function getBrightness() {
        return $this->brightness;
    }

    /**
     * @param  float $brightness
     * @return Color
     * @throws InvalidArgumentException
     */
    public function setBrightness($brightness) {
        $brightness = floatval($brightness);
        if($brightness < 0.0 or $brightness > 1.0) {
            throw new InvalidArgumentException('Brightness must be a float between 0.0 and 1.0 (inclusive).');
        }

        $this->brightness = $brightness;
        return $this;
    }

	/**
	 * @return array
     * @throws InvalidArgumentException
	 */
	public function render() {
        $hue = $this->getHue();
        $saturation = $this->getSaturation();
        $brightness = $this->getBrightness();

        $rendered = [
            'hue' => $hue,
            'saturation' => $saturation,
            'brightness' => $brightness,
        ];

        return $rendered;
	}
}
