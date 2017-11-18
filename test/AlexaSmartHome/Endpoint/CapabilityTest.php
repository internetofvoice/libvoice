<?php

namespace Tests\AlexaSmartHome\Endpoint;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class CapabilityTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class CapabilityTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testCapability() {
		$capability = new Capability('Alexa.PowerController', ['powerState'], true, true);
		$capability->setType('AlexaInterface');

		$expect = [
			'type' => 'AlexaInterface',
		    'interface' => 'Alexa.PowerController',
		    'version' => '3',
		    'properties' => [
				'supported' => [
                    ['name' => 'powerState'],
		        ],
                'proactivelyReported' => true,
		        'retrievable' => true,
			]
		];

		$this->assertEquals($expect, $capability->render());
	}

	/**
	 * @group smarthome
	 */
	public function testInvalidInterface() {
		$this->expectException(InvalidArgumentException::class);
		new Capability('Alexa.NonExistentController');
	}

	/**
	 * @group smarthome
	 */
	public function testInvalidProperty() {
		$this->expectException(InvalidArgumentException::class);
		new Capability('Alexa.PowerController', ['nonExistentProperty']);
	}

	/**
	 * @group smarthome
	 */
	public function testInvalidExtraProperty() {
		$capability = new Capability('Alexa.SceneController', [], true, true);
		$this->expectException(InvalidArgumentException::class);
		$capability->addExtraProperty('nonExistentExtraProperty', 'value');
	}
}
