<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value;

use \InvalidArgumentException;

/**
 * Class Resolution
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Resolution {
    /** @var int $width */
    protected $width;

    /** @var int $height */
    protected $height;

    /**
     * @param int $width
     * @param int $height
     */
    public function __construct($width = null, $height = null) {
        $this->setWidth($width);
        $this->setHeight($height);
    }

    /**
     * @return Resolution
     */
    public static function create() {
        return new Resolution();
    }

	/**
	 * @param  array $data
	 * @return Resolution
	 * @throws InvalidArgumentException
	 */
	public static function createFromArray($data) {
		$width = isset($data['width']) ? $data['width'] : null;
		$height = isset($data['height']) ? $data['height'] : null;

		if(is_null($width) or is_null($height)) {
			throw new InvalidArgumentException('Width and height must be given.');
		}

		return new Resolution($width, $height);
	}

    /**
     * @return int
     */
    public function getWidth() {
        return $this->width;
    }

    /**
     * @param int $width
     * @return Resolution
     */
    public function setWidth($width) {
        $this->width = intval($width);
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight() {
        return $this->height;
    }

    /**
     * @param int $height
     * @return Resolution
     */
    public function setHeight($height) {
        $this->height = intval($height);
        return $this;
    }


	/**
	 * @return array
     * @throws InvalidArgumentException
	 */
	public function render() {
        $width = $this->getWidth();
        $height = $this->getHeight();

        $rendered = [
            'width' => $width,
            'height' => $height,
        ];

        return $rendered;
	}
}
