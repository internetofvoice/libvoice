<?php

namespace Tests\AlexaSmartHome\Scope;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Scope\Scope;
use \PHPUnit\Framework\TestCase;

/**
 * Class ScopeTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ScopeTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testScope() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/DiscoveryRequest.json'), true);
		$scope   = new Scope($fixture['request']['directive']['payload']['scope']);

		$this->assertEquals('BearerToken', $scope->getType());
		$this->assertEquals('access-token-send-by-skill', $scope->getToken());

		$expect = [
			'type' => 'BearerToken',
			'token' => 'access-token-send-by-skill',
		];

		$this->assertEquals($expect, $scope->render());
	}
}