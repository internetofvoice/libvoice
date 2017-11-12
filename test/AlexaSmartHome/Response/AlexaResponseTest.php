<?php

namespace Tests\AlexaSmartHome\Response;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Request\Request\Directive\Header as RequestHeader;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\AlexaResponse;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event\Header;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Endpoint;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\Alexa;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\BrightnessController;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\CameraStreamConfiguration;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\CameraStreamController;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\ChannelController;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\ColorController;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\ColorTemperatureController;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\EndpointHealth;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\InputController;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\LockController;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\PercentageController;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\PowerController;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\PowerLevelController;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\SceneController;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\Speaker;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\TemperatureSensor;
use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\ThermostatController;
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

			->addEndpoint(Endpoint::create()
				->setEndpointId('endpoint-002')
				->setManufacturerName('Sample Manufacturer')
				->setFriendlyName('Light')
				->setDescription('002 Light that is dimmable and can change color and color temperature')
				->addDisplayCategory('LIGHT')
				->setCapabilities([
					new Alexa(),
					new PowerController(['powerState'], true, true),
					new ColorController(['color'], true, true),
					new ColorTemperatureController(['colorTemperatureInKelvin'], true, true),
					new BrightnessController(['brightness'], true, true),
					new PowerLevelController(['powerLevel'], true, true),
					new PercentageController(['percentage'], true, true),
					new EndpointHealth(['connectivity'], true, true),
				])
			)

            ->addEndpoint(Endpoint::create()
                ->setEndpointId('endpoint-003')
                ->setManufacturerName('Sample Manufacturer')
                ->setFriendlyName('White Light')
                ->setDescription('003 Light that is dimmable and can change color temperature only')
                ->addDisplayCategory('LIGHT')
                ->setCapabilities([
                    new Alexa(),
                    new PowerController(['powerState'], true, true),
                    new ColorTemperatureController(['colorTemperatureInKelvin'], true, true),
                    new BrightnessController(['brightness'], true, true),
                    new PowerLevelController(['powerLevel'], true, true),
                    new PercentageController(['percentage'], true, true),
                    new EndpointHealth(['connectivity'], true, true),
                ])
            )

            ->addEndpoint(Endpoint::create()
                ->setEndpointId('endpoint-004')
                ->setManufacturerName('Sample Manufacturer')
                ->setFriendlyName('Thermostat')
                ->setDescription('004 Thermostat that can change and query temperatures')
                ->addDisplayCategory('THERMOSTAT')
                ->setCapabilities([
                    new Alexa(),
                    new ThermostatController(['targetSetpoint', 'thermostatMode'], true, true),
                    new TemperatureSensor(['temperature'], true, true),
                    new EndpointHealth(['connectivity'], true, true),
                ])
            )

            ->addEndpoint(Endpoint::create()
                ->setEndpointId('endpoint-004-1')
                ->setManufacturerName('Sample Manufacturer')
                ->setFriendlyName('Living Room Thermostat')
                ->setDescription('004-1 Thermostat that can change and query temperatures, supports dual setpoints')
                ->addDisplayCategory('OTHER')
                ->setCapabilities([
                    new Alexa(),
                    new ThermostatController(['upperSetpoint', 'lowerSetpoint', 'thermostatMode'], true, true),
                    new TemperatureSensor(['temperature'], true, true),
                    new EndpointHealth(['connectivity'], true, true),
                ])
            )

            ->addEndpoint(Endpoint::create()
                ->setEndpointId('endpoint-005')
                ->setManufacturerName('Sample Manufacturer')
                ->setFriendlyName('Lock')
                ->setDescription('005 Lock that can be locked and can query lock state')
                ->addDisplayCategory('SMARTLOCK')
                ->setCapabilities([
                    new Alexa(),
                    new LockController(['lockState'], true, true),
                    new EndpointHealth(['connectivity'], true, true),
                ])
            )

            ->addEndpoint(Endpoint::create()
                ->setEndpointId('endpoint-006')
                ->setManufacturerName('Sample Manufacturer')
                ->setFriendlyName('Goodnight')
                ->setDescription('006 Scene that can only be turned on')
                ->addDisplayCategory('SCENE_TRIGGER')
                ->setCapabilities([
                    new Alexa(),
                    new SceneController(false, true),
                    new EndpointHealth(['connectivity'], true, true),
                ])
            )

            ->addEndpoint(Endpoint::create()
                ->setEndpointId('endpoint-007')
                ->setManufacturerName('Sample Manufacturer')
                ->setFriendlyName('Watch TV')
                ->setDescription('007 Activity that runs sequentially that can be turned on and off')
                ->addDisplayCategory('ACTIVITY_TRIGGER')
                ->setCapabilities([
                    new Alexa(),
                    new SceneController(true, true),
                    new EndpointHealth(['connectivity'], true, true),
                ])
            )

            ->addEndpoint(Endpoint::create()
                ->setEndpointId('endpoint-008')
                ->setManufacturerName('Sample Manufacturer')
                ->setFriendlyName('Baby Camera')
                ->setDescription('008 Camera that streams from an RSTP source')
                ->addDisplayCategory('CAMERA')
                ->setCapabilities([
                    new Alexa(),
                    new CameraStreamController([
                        CameraStreamConfiguration::create()
                            ->addProtocol('RTSP')
                            ->addResolution(1280, 720)
                            ->addAuthorizationType('NONE')
                            ->addVideoCodec('H264')
                            ->addAudioCodec('AAC')
                    ]),
                    new EndpointHealth(['connectivity'], true, true),
                ])
            )

            ->addEndpoint(Endpoint::create()
                ->setEndpointId('endpoint-009')
                ->setManufacturerName('Sample Manufacturer')
                ->setFriendlyName('TV')
                ->setDescription('009 TV that supports various entertainment controllers')
                ->addDisplayCategory('OTHER')
                ->setCapabilities([
                    new Alexa(),
                    new ChannelController(['channel'], true, true),
                    new InputController(['input'], true, true),
                    new Speaker(['volume', 'muted'], true, true),
                    new EndpointHealth(['connectivity'], true, true),
                ])
            )
		;

		$expect = json_decode(file_get_contents(__DIR__ . '/Fixtures/DiscoveryResponse.json'), true);
		$this->assertEquals($expect, $alexaResponse->render());
	}
}
