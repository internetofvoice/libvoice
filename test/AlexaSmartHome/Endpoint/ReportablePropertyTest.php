<?php

namespace Tests\AlexaSmartHome\Endpoint;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\ReportableProperty;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\Temperature;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class ReportablePropertyTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ReportablePropertyTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testReportableProperty() {
		$property = new ReportableProperty('Alexa.PowerController', 'powerState', 'ON', new \DateTime('2017-01-01 00:00:00'), 1000);

		$expect = [
			'namespace' => 'Alexa.PowerController',
			'name' => 'powerState',
			'value' => 'ON',
			'timeOfSample' => '2017-01-01T00:00:00+01:00',
			'uncertaintyInMilliseconds' => 1000,
		];

		$this->assertEquals($expect, $property->render());
		$this->assertEquals('Alexa.PowerController', $property->getNamespace());
		$this->assertEquals('powerState', $property->getName());
		$this->assertEquals(new \DateTime('2017-01-01 00:00:00'), $property->getTimeOfSample());
		$this->assertEquals('2017-01-01T00:00:00+01:00', $property->getTimeOfSampleAsString());
		$this->assertEquals(1000, $property->getUncertaintyInMilliseconds());

		$property->setValue(new Temperature(20, 'CELSIUS'));
		$rendered = $property->render();
		$this->assertEquals('CELSIUS', $rendered['value']['scale']);

		$property->setValue([new Temperature(20, 'CELSIUS')]);
		$rendered = $property->render();
		$this->assertEquals('CELSIUS', $rendered['value'][0]['scale']);

		$property->setValue([10, 20, 30]);
		$rendered = $property->render();
		$this->assertEquals(20, $rendered['value'][1]);
	}

	/**
	 * @group smarthome
	 */
	public function testInvalidInterface() {
		$this->expectException(InvalidArgumentException::class);
		new ReportableProperty('Alexa.NonExistentController', '', '');
	}

	/**
	 * @group smarthome
	 */
	public function testInvalidProperty() {
		$this->expectException(InvalidArgumentException::class);
		new ReportableProperty('Alexa.PowerController', 'nonExistentProperty', '');
	}

	/**
	 * @group smarthome
	 */
	public function testInvalidDate() {
		$this->expectException(InvalidArgumentException::class);
		new ReportableProperty('Alexa.PowerController', 'powerState', 'ON', '2017-01-01 00:00:00');
	}
}

