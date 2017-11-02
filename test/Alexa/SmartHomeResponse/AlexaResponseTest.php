<?php

namespace Tests\Alexa\SmartHomeResponse;

use \InternetOfVoice\LibVoice\Alexa\SmartHomeRequest\Request\Directive\Header as RequestHeader;
use \InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\AlexaResponse;
use \InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event\Header;
use \InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event\Payload\Endpoint;
use \InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event\Payload\Endpoint\Capability\Alexa;
use \InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event\Payload\Endpoint\Capability\EndpointHealth;
use \InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event\Payload\Endpoint\Capability\PowerController;
use \PHPUnit\Framework\TestCase;

/**
 * Class AlexaResponseTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class AlexaResponseTest extends TestCase {
	/**
	 * testAlexaResponseWithoutPayload
	 *
	 * @group smarthome
	 */
	public function testAlexaResponseWithoutPayload() {
		$alexaResponse = AlexaResponse::create();
		$alexaResponse->getHeader()
			->setNamespace('Alexa.Discovery')
			->setName('Discover.Response')
			->setPayloadVersion('3')
			->setMessageId('0a58ace0-e6ab-47de-b6af-b600b5ab8a7a')
		;

		$expect = json_decode(file_get_contents(__DIR__ . '/Fixtures/DiscoveryResponse.json'), true);
		unset($expect['response']['event']['payload']['endpoints']);
		$this->assertEquals($expect, $alexaResponse->render());
	}

	/**
	 * testAlexaResponseHeaderFromRequestHeader
	 *
	 * @group smarthome
	 */
	public function testAlexaResponseHeaderFromRequestHeader() {
		$fixture = [
			'namespace'      => 'Alexa.Discovery',
			'name'           => 'Discover.Response',
			'payloadVersion' => '3',
			'messageId'      => '0a58ace0-e6ab-47de-b6af-b600b5ab8a7a',
		];

		// 1. via constructor params
		$header = new Header($fixture);
		$this->assertEquals($fixture, $header->render());


		// 2. via createFromRequestHeader (keep messageId)
		$requestHeader = new RequestHeader($fixture);
		$header->createFromRequestHeader($requestHeader, false);
		$this->assertEquals($fixture, $header->render());

		// 2. via createFromRequestHeader (new messageId)
		$requestHeader = new RequestHeader($fixture);
		$header->createFromRequestHeader($requestHeader);
		$rendered = $header->render();
		$this->assertNotEquals($fixture, $rendered);

		unset($fixture['messageId'], $rendered['messageId']);
		$this->assertEquals($fixture, $rendered);
	}

	/**
	 * testAlexaResponse
	 *
	 * @group smarthome
	 */
	public function testAlexaResponse() {
		$alexaResponse = AlexaResponse::create();
		$alexaResponse->getHeader()
			->setNamespace('Alexa.Discovery')
			->setName('Discover.Response')
			->setPayloadVersion('3')
			->setMessageId('0a58ace0-e6ab-47de-b6af-b600b5ab8a7a')
		;

		$alexaResponse->getPayload()
            ->addEndpoint(Endpoint::create()
				->setEndpointId('endpoint-001')
				->setManufacturerName('Sample Manufacturer')
				->setFriendlyName('Switch')
				->setDescription('001 Switch that can only be turned on/off')
				->addDisplayCategory('SWITCH')
				->setCookie('detail1', 'For simplicity, this is the only appliance')
				->setCookie('detail2', 'that has some values in the additionalApplianceDetails')
				->setCapabilities([
					new Alexa(),
					new PowerController(['powerState'], true, true),
					new EndpointHealth(['connectivity'], true, true),
			    ])
            )
		;

		$expect = json_decode(file_get_contents(__DIR__ . '/Fixtures/DiscoveryResponse.json'), true);
		$expect['response']['event']['payload']['endpoints'] = array_slice($expect['response']['event']['payload']['endpoints'], 0, 1);
		$this->assertEquals($expect, $alexaResponse->render());
	}
}
