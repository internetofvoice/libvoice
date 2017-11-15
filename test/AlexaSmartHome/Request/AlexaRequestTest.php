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
	 * @group smarthome
	 */
	public function testDiscoveryRequest() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/DiscoveryRequest.json'), true);
		$alexaRequest = new AlexaRequest($fixture);

		// Header
		$this->assertEquals('Alexa.Discovery', $alexaRequest->getRequest()->getDirective()->getHeader()->getNamespace());
		$this->assertEquals('Discover', $alexaRequest->getRequest()->getDirective()->getHeader()->getName());
		$this->assertEquals('3', $alexaRequest->getRequest()->getDirective()->getHeader()->getPayloadVersion());
		$this->assertRegExp('/^[0-9a-zA-Z-]{36}$/', $alexaRequest->getRequest()->getDirective()->getHeader()->getMessageId());
		$this->assertEquals('abcdef-123456', $alexaRequest->getRequest()->getDirective()->getHeader()->getCorrelationToken());

		// Payload
        $this->assertEquals('BearerToken', $alexaRequest->getRequest()->getDirective()->getPayload()->getScope()->getType());
        $this->assertEquals('access-token-send-by-skill', $alexaRequest->getRequest()->getDirective()->getPayload()->getScope()->getToken());

        // Context
        $this->assertEquals('ReConSkillAdapter', $alexaRequest->getContext()->getData()['functionName']);

        // Test shortcuts
        $this->assertEquals('Alexa.Discovery', $alexaRequest->getHeader()->getNamespace());
        $this->assertEquals('BearerToken', $alexaRequest->getPayload()->getScope()->getType());
	}

	/**
	 * @group smarthome
	 */
	public function testReportStateRequest() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/ReportStateRequest.json'), true);
		$alexaRequest = new AlexaRequest($fixture);

		// Header
		$this->assertEquals('Alexa', $alexaRequest->getRequest()->getDirective()->getHeader()->getNamespace());
		$this->assertEquals('ReportState', $alexaRequest->getRequest()->getDirective()->getHeader()->getName());
		$this->assertEquals('3', $alexaRequest->getRequest()->getDirective()->getHeader()->getPayloadVersion());
		$this->assertRegExp('/^[0-9a-zA-Z-]{36}$/', $alexaRequest->getRequest()->getDirective()->getHeader()->getMessageId());
		$this->assertEquals('abcdef-123456', $alexaRequest->getRequest()->getDirective()->getHeader()->getCorrelationToken());

		// Endpoint
		$this->assertEquals('BearerToken', $alexaRequest->getRequest()->getDirective()->getEndpoint()->getScope()->getType());
		$this->assertEquals('endpoint-01', $alexaRequest->getRequest()->getDirective()->getEndpoint()->getEndpointId());

		// Context
		$this->assertEquals('ReConSkillAdapter', $alexaRequest->getContext()->getData()['functionName']);

		// Test shortcuts
		$this->assertEquals('ReportState', $alexaRequest->getHeader()->getName());
		$this->assertEquals('BearerToken', $alexaRequest->getEndpoint()->getScope()->getType());
	}
}
