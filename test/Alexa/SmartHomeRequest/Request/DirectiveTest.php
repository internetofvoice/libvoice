<?php

namespace Tests\Alexa\SmartHomeRequest\Request\Directive;

use \InternetOfVoice\LibVoice\Alexa\SmartHomeRequest\Request\Directive;
use \PHPUnit\Framework\TestCase;

/**
 * Class DirectiveTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class DirectiveTest extends TestCase {
	/**
	 * testDirective
	 *
	 * @group smarthome
	 */
	public function testDirective() {
		$fixture   = json_decode(file_get_contents(__DIR__ . '/../Fixtures/DiscoveryRequest.json'), true);
		$directive = new Directive($fixture['request']['directive']);

		$this->assertEquals('Alexa.Discovery', $directive->getHeader()->getNamespace());
		$this->assertEquals('Discover', $directive->getHeader()->getName());
		$this->assertEquals('3', $directive->getHeader()->getPayloadVersion());
		$this->assertRegExp('/^[0-9a-zA-Z-]{36}$/', $directive->getHeader()->getMessageId());

        $this->assertEquals('BearerToken', $directive->getPayload()->getScope()->getType());
        $this->assertEquals('access-token-send-by-skill', $directive->getPayload()->getScope()->getToken());
	}
}
