<?php

namespace Tests\AlexaSmartHome\Endpoint;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Relation;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

class RelationObject extends Relation {
}

/**
 * Class RelationTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class RelationTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testRelation() {
		$relation = new RelationObject();
		$this->assertEquals(3, $relation->getApiVersion());
		$this->assertTrue($relation->isInterfaceAvailable('Alexa.PowerController'));
		$this->assertFalse($relation->isInterfaceAvailable('Alexa.NonExistentController'));

		$directives = $relation->getDirectivesFor('Alexa.PowerController');
		$expect = ['TurnOn' => [], 'TurnOff' => []];
		$this->assertEquals($expect, $directives);
	}

	/**
	 * @group smarthome
	 */
	public function testInvalidDirectivesInterface() {
		$relation = new RelationObject();
		$this->expectException(InvalidArgumentException::class);
		$relation->getDirectivesFor('Alexa.NonExistentController');
	}

	/**
	 * @group smarthome
	 */
	public function testInvalidPropertiesInterface() {
		$relation = new RelationObject();
		$this->expectException(InvalidArgumentException::class);
		$relation->getPropertiesFor('Alexa.NonExistentController');
	}

	/**
	 * @group smarthome
	 */
	public function testInvalidExtraPropertiesInterface() {
		$relation = new RelationObject();
		$this->expectException(InvalidArgumentException::class);
		$relation->getExtraPropertiesFor('Alexa.NonExistentController');
	}

	/**
	 * @group smarthome
	 */
	public function testInvalidExtraProperties() {
		$relation = new RelationObject();
		$this->expectException(InvalidArgumentException::class);
		$relation->getExtraPropertiesFor('Alexa.PowerController');
	}
}
