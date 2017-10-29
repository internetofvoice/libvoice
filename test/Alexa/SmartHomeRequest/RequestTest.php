<?php

namespace Tests\Alexa\SmartHomeRequest\Request\Directive;

use \InternetOfVoice\LibVoice\Alexa\SmartHomeRequest\Request;
use \PHPUnit\Framework\TestCase;

/**
 * Class RequestTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class RequestTest extends TestCase {
	/**
	 * testRequest
	 *
	 * @group smarthome
	 */
	public function testRequest() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/Fixtures/DiscoveryRequest.json'), true);
		$request = new Request($fixture['request']);

		$this->assertEquals('Alexa.Discovery', $request->getDirective()->getHeader()->getNamespace());
		$this->assertEquals('Discover', $request->getDirective()->getHeader()->getName());
		$this->assertEquals('3', $request->getDirective()->getHeader()->getPayloadVersion());
		$this->assertRegExp('/^[0-9a-zA-Z-]{36}$/', $request->getDirective()->getHeader()->getMessageId());

        $this->assertEquals('BearerToken', $request->getDirective()->getPayload()->getScope()->getType());
        $this->assertTrue(strlen($request->getDirective()->getPayload()->getScope()->getToken()) > 128);
	}
}
