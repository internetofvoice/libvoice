<?php

namespace Tests\AlexaSmartHome\Scope;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Scope\Grant;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Scope\Grantee;
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

	/**
	 * @group smarthome
	 */
	public function testGrant() {
		$fixture = ['type' => 'OAuth2.AuthorizationCode', 'code' => 'my_secret'];
		$grant   = new Grant($fixture);

		$this->assertEquals('OAuth2.AuthorizationCode', $grant->getType());
		$this->assertEquals('my_secret', $grant->getCode());

		$expect = [
			'type' => 'OAuth2.AuthorizationCode',
			'code' => 'my_secret',
		];

		$this->assertEquals($expect, $grant->render());
	}

	/**
	 * @group smarthome
	 */
	public function testGrantee() {
		$fixture = ['type' => 'BearerToken', 'token' => 'my_token'];
		$grantee = new Grantee($fixture);

		$this->assertEquals('BearerToken', $grantee->getType());
		$this->assertEquals('my_token', $grantee->getToken());

		$expect = [
			'type' => 'BearerToken',
			'token' => 'my_token',
		];

		$this->assertEquals($expect, $grantee->render());
	}
}
