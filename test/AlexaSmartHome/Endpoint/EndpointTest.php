<?php

namespace Tests\AlexaSmartHome\Endpoint;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Endpoint;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Scope\Scope;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class EndpointTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class EndpointTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testEndpoint() {
		$endpoint = Endpoint::create()
			->setEndpointId('endpoint-005')
			->setManufacturerName('Sample Manufacturer')
			->setFriendlyName('Lock')
			->setDescription('005 Lock that can be locked and can query lock state')
		;

		$endpoint->setDisplayCategories(['SMARTLOCK']);
		$endpoint->setCookie('cookie', 'value');
		$endpoint->setScope(new Scope([]));

		$expect = [
			'endpointId' => 'endpoint-005',
		    'manufacturerName' => 'Sample Manufacturer',
		    'friendlyName' => 'Lock',
		    'description' => '005 Lock that can be locked and can query lock state',
			'displayCategories' => ['SMARTLOCK'],
			'cookie' => ['cookie' => 'value'],
			'scope' => [],
		];

		$this->assertEquals($expect, $endpoint->render());
		$this->assertEquals('value', $endpoint->getCookie('cookie'));
	}

	/**
	 * @group smarthome
	 */
	public function testConstructor() {
		$endpoint = new Endpoint([
			'endpointId' => 'endpoint-005',
			'manufacturerName' => 'Sample Manufacturer',
			'friendlyName' => 'Lock',
			'description' => '005 Lock that can be locked and can query lock state',
			'displayCategories' => ['SMARTLOCK'],
			'cookie' => ['cookie' => 'value'],
			'capabilities' => [],
			'scope' => [],
		]);

		$expect = [
			'endpointId' => 'endpoint-005',
			'manufacturerName' => 'Sample Manufacturer',
			'friendlyName' => 'Lock',
			'description' => '005 Lock that can be locked and can query lock state',
			'displayCategories' => ['SMARTLOCK'],
			'cookie' => ['cookie' => 'value'],
			'scope' => [],
		];

		$this->assertEquals($expect, $endpoint->render());
	}

	/**
	 * @group smarthome
	 */
	public function testInvalidInterface() {
		$endpoint = Endpoint::create()
			->setEndpointId('endpoint-005')
			->setManufacturerName('Sample Manufacturer')
			->setFriendlyName('Lock')
			->setDescription('005 Lock that can be locked and can query lock state')
		;

		$this->expectException(InvalidArgumentException::class);
		$endpoint->addDisplayCategory('NON_EXISTENT_CATEGORY');
	}
}
