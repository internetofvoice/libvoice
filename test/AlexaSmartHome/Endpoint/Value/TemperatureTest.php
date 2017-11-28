<?php

namespace Tests\AlexaSmartHome\Endpoint\Value;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\Temperature;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class TemperatureTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class TemperatureTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testTemperatureCreate() {
        $temperature = Temperature::create()
	        ->setValue(25.0)
	        ->setScale('CELSIUS')
        ;

		$expect = [
			'value' => 25.0,
			'scale' => 'CELSIUS',
		];

		$this->assertEquals($expect, $temperature->render());
	}

    /**
     * @group smarthome
     */
    public function testTemperatureCreateFromArray() {
        $fixture = [
            'value' => 25.0,
            'scale' => 'CELSIUS',
        ];

        $temperature = Temperature::createFromArray($fixture);
        $this->assertEquals($fixture, $temperature->render());
    }

	/**
	 * @group smarthome
	 */
	public function testInvalidScale() {
		$this->expectException(InvalidArgumentException::class);
		new Temperature(25.0, 'Newton');
	}

	/**
	 * @group smarthome
	 */
	public function testMissingValue() {
		$temperature = new Temperature();
		$this->expectException(InvalidArgumentException::class);
		$temperature->render();
	}

    /**
     * @group smarthome
     */
    public function testInvalidCreateFromArray() {
        $this->expectException(InvalidArgumentException::class);
        Temperature::createFromArray([]);
    }
}
