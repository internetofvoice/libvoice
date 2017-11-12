<?php

namespace Tests\AlexaSmartHome\Request;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Request\AlexaRequest;
use \PHPUnit\Framework\TestCase;

/**
 * Class AlexaRequestTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class AlexaRequestTest extends TestCase {
	/**
	 * testAlexaRequest
	 *
	 * @group smarthome
	 */
	public function testAlexaRequest() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/Fixtures/DiscoveryRequest.json'), true);
		$alexaRequest = new AlexaRequest($fixture);

		$this->assertEquals('Alexa.Discovery', $alexaRequest->getRequest()->getDirective()->getHeader()->getNamespace());
		$this->assertEquals('Discover', $alexaRequest->getRequest()->getDirective()->getHeader()->getName());
		$this->assertEquals('3', $alexaRequest->getRequest()->getDirective()->getHeader()->getPayloadVersion());
		$this->assertRegExp('/^[0-9a-zA-Z-]{36}$/', $alexaRequest->getRequest()->getDirective()->getHeader()->getMessageId());

        $this->assertEquals('BearerToken', $alexaRequest->getRequest()->getDirective()->getPayload()->getScope()->getType());
        $this->assertEquals('access-token-send-by-skill', $alexaRequest->getRequest()->getDirective()->getPayload()->getScope()->getToken());

        $this->assertEquals('ReConSkillAdapter', $alexaRequest->getContext()->getData()['functionName']);

        // Shortcuts
        $this->assertEquals('Alexa.Discovery', $alexaRequest->getHeader()->getNamespace());
        $this->assertEquals('BearerToken', $alexaRequest->getPayload()->getScope()->getType());
	}
}
