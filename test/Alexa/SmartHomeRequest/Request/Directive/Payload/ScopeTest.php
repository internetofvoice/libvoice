<?php

namespace Tests\Alexa\SmartHomeRequest\Request\Directive\Payload;

use \InternetOfVoice\LibVoice\Alexa\SmartHomeRequest\Request\Directive\Payload\Scope;
use \PHPUnit\Framework\TestCase;

/**
 * Class ScopeTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ScopeTest extends TestCase {
	/**
	 * testScope
	 *
	 * @group smarthome
	 */
	public function testScope() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../../../Fixtures/DiscoveryRequest.json'), true);

		$scope = new Scope($fixture['request']['directive']['payload']['scope']);

		$this->assertEquals('BearerToken', $scope->getType());
		$this->assertTrue(strlen($scope->getToken()) > 32);
	}
}
