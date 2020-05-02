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
    protected $width = 0;

    /** @var int $height */
    protected $height = 0;


    /**
     * @param int $width
     * @param int $height
     */
    public function __construct(int $width, int $height) {
        $this->setWidth($width);
        $this->setHeight($height);
    }

    /**
     * @return Resolution
     */
    public static function create(): Resolution {
        return new Resolution(0, 0);
    }

	/**
	 * @param  array $data
	 *
	 * @return Resolution
	 *
	 * @throws InvalidArgumentException
	 */
	public static function createFromArray(array $data) {
		$width  = isset($data['width']) ? $data['width'] : 0;
		$height = isset($data['height']) ? $data['height'] : 0;

		if(!$width or !$height) {
			throw new InvalidArgumentException('Width and height must be given.');
		}

		return new Resolution($width, $height);
	}

    /**
     * @return int
     */
    public function getWidth(): int {
        return $this->width;
    }

    /**
     * @param  int $width
     *
     * @return Resolution
     */
    public function setWidth(int $width): Resolution {
        $this->width = intval($width);

        return $this;
    }

    /**
     * @return int
     */
    public function getHeight(): int {
        return $this->height;
    }

    /**
     * @param  int $height
     *
     * @return Resolution
     */
    public function setHeight(int $height): Resolution {
        $this->height = intval($height);
        return $this;
    }


	/**
	 * @return array
	 */
	public function render(): array {
        return [
	        'width'  => $this->getWidth(),
	        'height' => $this->getHeight(),
        ];
	}
}
