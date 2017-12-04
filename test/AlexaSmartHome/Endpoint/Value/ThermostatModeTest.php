<?php

namespace Tests\AlexaSmartHome\Endpoint\Value;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\ThermostatMode;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class ThermostatModeTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ThermostatModeTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testConstructor() {
		$mode = new ThermostatMode('AUTO');
		$expect = [
			'value' => 'AUTO',
		];

		$this->assertEquals($expect, $mode->render());
	}

	/**
	 * @group smarthome
	 */
	public function testCreateFromArray() {
		$fixture = [
			'value' => 'CUSTOM',
			'customName' => 'My Name',
		];

		$mode = ThermostatMode::createFromArray($fixture);
		$this->assertEquals($fixture, $mode->render());
	}

	/**
	 * @group smarthome
	 */
	public function testMissingValue() {
		$this->expectException(InvalidArgumentException::class);
		new ThermostatMode();
	}
}
