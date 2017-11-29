<?php

namespace Tests\AlexaSmartHome\Endpoint\Value;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\Color;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class ColorTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ColorTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testColorCreate() {
        $color = Color::create()
			->setHue(180.0)
	        ->setSaturation(0.5)
	        ->setBrightness(1.0)
        ;

		$expect = [
			'hue' => 180.0,
			'saturation' => 0.5,
			'brightness' => 1.0,
		];

		$this->assertEquals($expect, $color->render());
	}

    /**
     * @group smarthome
     */
    public function testColorCreateFromArray() {
        $fixture = [
            'hue' => 180.0,
            'saturation' => 0.5,
            'brightness' => 1.0,
        ];

        $color = Color::createFromArray($fixture);
        $this->assertEquals($fixture, $color->render());
    }

	/**
	 * @group smarthome
	 */
	public function testInvalidHue() {
		$this->expectException(InvalidArgumentException::class);
		new Color(-1, 0.5, 1.0);
	}

	/**
	 * @group smarthome
	 */
	public function testInvalidSaturation() {
		$this->expectException(InvalidArgumentException::class);
		new Color(180.0, 2.0, 1.0);
	}

	/**
	 * @group smarthome
	 */
	public function testInvalidBrightness() {
		$this->expectException(InvalidArgumentException::class);
		new Color(180.0, 0.5, -2.0);
	}

    /**
     * @group smarthome
     */
    public function testInvalidCreateFromArray() {
        $this->expectException(InvalidArgumentException::class);
        Color::createFromArray([]);
    }
}
