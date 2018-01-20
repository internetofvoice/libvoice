<?php

namespace Tests\AlexaSmartHome\Response;

use \DateTime;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Endpoint;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\ReportableProperty;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\CameraStreamConfiguration;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Request\Request\Directive\Header as RequestHeader;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\AlexaResponse;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Context;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event\Header;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class AlexaResponseTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class AlexaResponseTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testAlexaResponseWithoutPayload() {
		$alexaResponse = AlexaResponse::create('Discovery');
		$alexaResponse->getHeader()
			->setNamespace('Alexa.Discovery')
			->setName('Discover.Response')
			->setPayloadVersion('3')
			->setMessageId('0a58ace0-e6ab-47de-b6af-b600b5ab8a7a')
		;

		$expect = json_decode(file_get_contents(__DIR__ . '/../Fixtures/DiscoveryResponse.json'), true);
		unset($expect['response']['event']['payload']['endpoints']);
		$this->assertEquals($expect, $alexaResponse->render());
	}

	/**
	 * @group smarthome
	 */
	public function testAlexaResponseStateReportTemplate() {
		$alexaResponse = AlexaResponse::create('StateReport');
		$expect = [
			'response' => [
				'event' => [
					'header' => [
						'namespace' => 'Alexa',
						'name' => null,
						'payloadVersion' => '3',
						'messageId' => null,
					],
					'payload' => [],
					'endpoint' => [
						'endpointId' => null,
					],
				],
				'context' => [],
			],
		];

		$this->assertEquals($expect, $alexaResponse->render());
	}

	/**
	 * @group smarthome
	 */
	public function testAlexaResponseResponseTemplate() {
		$alexaResponse = AlexaResponse::create('Response');
		$expect = [
			'response' => [
				'event' => [
					'header' => [
						'namespace' => 'Alexa',
						'name' => null,
						'payloadVersion' => '3',
						'messageId' => null,
					],
					'payload' => [],
					'endpoint' => [
						'endpointId' => null,
					],
				],
				'context' => [],
			],
		];

		$this->assertEquals($expect, $alexaResponse->render());
		$this->assertEquals(['endpointId' => null], $alexaResponse->getEndpoint()->render());

		$time     = new DateTime('2017-01-01 00:00:00');
		$property = new ReportableProperty('Alexa.BrightnessController', 'brightness', 100, $time);
		$context  = new Context([$property]);
		$alexaResponse->setContext($context);
		$this->assertContains('BrightnessController', json_encode($alexaResponse->render()));
	}

	/**
	 * @group smarthome
	 */
	public function testAlexaResponseAuthorizationTemplate() {
		$alexaResponse = AlexaResponse::create('Authorization');
		$expect = [
			'response' => [
				'event' => [
					'header' => [
						'namespace' => 'Alexa',
						'name' => null,
						'payloadVersion' => '3',
						'messageId' => null,
					],
					'payload' => [],
				]
			],
		];

		$this->assertEquals($expect, $alexaResponse->render());
	}

	/**
	 * @group smarthome
	 */
	public function testAlexaResponseErrorTemplate() {
		$alexaResponse = AlexaResponse::create('Error');
		$expect = [
			'response' => [
				'event' => [
					'header' => [
						'namespace' => 'Alexa',
						'name' => null,
						'payloadVersion' => '3',
						'messageId' => null,
					],
					'payload' => [],
				]
			],
		];

		$this->assertEquals($expect, $alexaResponse->render());
	}

	/**
	 * @group smarthome
	 */
	public function testAlexaResponseInvalidTemplate() {
		$this->expectException(InvalidArgumentException::class);
		AlexaResponse::create('NonExistentTemplate');
	}

	/**
	 * @group smarthome
	 */
	public function testAlexaResponseHeaderFromRequestHeader() {
		$fixture = [
            'namespace'         => 'Alexa.Discovery',
            'name'              => 'Discover.Response',
            'payloadVersion'    => '3',
            'messageId'         => '0a58ace0-e6ab-47de-b6af-b600b5ab8a7a',
            'correlationToken'  => 'correlation-token-123',
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
	 * @group smarthome
	 */
	public function testAlexaResponse() {
		$alexaResponse = AlexaResponse::create('Discovery');
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
					new Capability('Alexa'),
					new Capability('Alexa.PowerController', ['powerState'], true, true),
					new Capability('Alexa.EndpointHealth', ['connectivity'], true, true),
			    ])
            )

			->addEndpoint(Endpoint::create()
				->setEndpointId('endpoint-002')
				->setManufacturerName('Sample Manufacturer')
				->setFriendlyName('Light')
				->setDescription('002 Light that is dimmable and can change color and color temperature')
				->addDisplayCategory('LIGHT')
				->setCapabilities([
                    new Capability('Alexa'),
                    new Capability('Alexa.PowerController', ['powerState'], true, true),
                    new Capability('Alexa.ColorController', ['color'], true, true),
                    new Capability('Alexa.ColorTemperatureController', ['colorTemperatureInKelvin'], true, true),
                    new Capability('Alexa.BrightnessController', ['brightness'], true, true),
                    new Capability('Alexa.PowerLevelController', ['powerLevel'], true, true),
                    new Capability('Alexa.PercentageController', ['percentage'], true, true),
                    new Capability('Alexa.EndpointHealth', ['connectivity'], true, true),
				])
			)

            ->addEndpoint(Endpoint::create()
                ->setEndpointId('endpoint-003')
                ->setManufacturerName('Sample Manufacturer')
                ->setFriendlyName('White Light')
                ->setDescription('003 Light that is dimmable and can change color temperature only')
                ->addDisplayCategory('LIGHT')
                ->setCapabilities([
                    new Capability('Alexa'),
                    new Capability('Alexa.PowerController', ['powerState'], true, true),
                    new Capability('Alexa.ColorTemperatureController', ['colorTemperatureInKelvin'], true, true),
                    new Capability('Alexa.BrightnessController', ['brightness'], true, true),
                    new Capability('Alexa.PowerLevelController', ['powerLevel'], true, true),
                    new Capability('Alexa.PercentageController', ['percentage'], true, true),
                    new Capability('Alexa.EndpointHealth', ['connectivity'], true, true),
                ])
            )

            ->addEndpoint(Endpoint::create()
                ->setEndpointId('endpoint-004')
                ->setManufacturerName('Sample Manufacturer')
                ->setFriendlyName('Thermostat')
                ->setDescription('004 Thermostat that can change and query temperatures')
                ->addDisplayCategory('THERMOSTAT')
                ->setCapabilities([
                    new Capability('Alexa'),
                    new Capability('Alexa.ThermostatController', ['targetSetpoint', 'thermostatMode'], true, true),
                    new Capability('Alexa.TemperatureSensor', ['temperature'], true, true),
                    new Capability('Alexa.EndpointHealth', ['connectivity'], true, true),
                ])
            )

            ->addEndpoint(Endpoint::create()
                ->setEndpointId('endpoint-004-1')
                ->setManufacturerName('Sample Manufacturer')
                ->setFriendlyName('Living Room Thermostat')
                ->setDescription('004-1 Thermostat that can change and query temperatures, supports dual setpoints')
                ->addDisplayCategory('OTHER')
                ->setCapabilities([
                    new Capability('Alexa'),
                    new Capability('Alexa.ThermostatController', ['upperSetpoint', 'lowerSetpoint', 'thermostatMode'], true, true),
                    new Capability('Alexa.TemperatureSensor', ['temperature'], true, true),
                    new Capability('Alexa.EndpointHealth', ['connectivity'], true, true),
                ])
            )

            ->addEndpoint(Endpoint::create()
                ->setEndpointId('endpoint-005')
                ->setManufacturerName('Sample Manufacturer')
                ->setFriendlyName('Lock')
                ->setDescription('005 Lock that can be locked and can query lock state')
                ->addDisplayCategory('SMARTLOCK')
                ->setCapabilities([
                    new Capability('Alexa'),
                    new Capability('Alexa.LockController', ['lockState'], true, true),
                    new Capability('Alexa.EndpointHealth', ['connectivity'], true, true),
                ])
            )

            ->addEndpoint(Endpoint::create()
                ->setEndpointId('endpoint-006')
                ->setManufacturerName('Sample Manufacturer')
                ->setFriendlyName('Goodnight')
                ->setDescription('006 Scene that can only be turned on')
                ->addDisplayCategory('SCENE_TRIGGER')
                ->setCapabilities([
                    new Capability('Alexa'),
                    new Capability('Alexa.SceneController', null, null, null, [
                        'supportsDeactivation' => false,
                        'proactivelyReported' => true,
                    ]),
                    new Capability('Alexa.EndpointHealth', ['connectivity'], true, true),
                ])
            )

            ->addEndpoint(Endpoint::create()
                ->setEndpointId('endpoint-007')
                ->setManufacturerName('Sample Manufacturer')
                ->setFriendlyName('Watch TV')
                ->setDescription('007 Activity that runs sequentially that can be turned on and off')
                ->addDisplayCategory('ACTIVITY_TRIGGER')
                ->setCapabilities([
                    new Capability('Alexa'),
                    new Capability('Alexa.SceneController', null, null, null, [
                        'supportsDeactivation' => true,
                        'proactivelyReported' => true,
                    ]),
                    new Capability('Alexa.EndpointHealth', ['connectivity'], true, true),
                ])
            )

            ->addEndpoint(Endpoint::create()
                ->setEndpointId('endpoint-008')
                ->setManufacturerName('Sample Manufacturer')
                ->setFriendlyName('Baby Camera')
                ->setDescription('008 Camera that streams from an RSTP source')
                ->addDisplayCategory('CAMERA')
                ->setCapabilities([
                    new Capability('Alexa'),
                    new Capability('Alexa.CameraStreamController', null, null, null, [
                        'cameraStreamConfigurations' => [
                            CameraStreamConfiguration::create()
                                ->addProtocol('RTSP')
                                ->addResolution(1280, 720)
                                ->addAuthorizationType('NONE')
                                ->addVideoCodec('H264')
                                ->addAudioCodec('AAC')
                            ]
                    ]),
                    new Capability('Alexa.EndpointHealth', ['connectivity'], true, true),
                ])
            )

            ->addEndpoint(Endpoint::create()
                ->setEndpointId('endpoint-009')
                ->setManufacturerName('Sample Manufacturer')
                ->setFriendlyName('TV')
                ->setDescription('009 TV that supports various entertainment controllers')
                ->addDisplayCategory('OTHER')
                ->setCapabilities([
                    new Capability('Alexa'),
                    new Capability('Alexa.ChannelController', ['channel'], true, true),
                    new Capability('Alexa.InputController', ['input'], true, true),
                    new Capability('Alexa.Speaker', ['volume', 'muted'], true, true),
                    new Capability('Alexa.EndpointHealth', ['connectivity'], true, true),
                ])
            )
		;

		$expect = json_decode(file_get_contents(__DIR__ . '/../Fixtures/DiscoveryResponse.json'), true);
		$this->assertEquals($expect, $alexaResponse->render());
	}
}
