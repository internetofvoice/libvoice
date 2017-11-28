<?php

namespace Tests\AlexaSmartHome\Request\Request\Directive;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\CameraStreamConfiguration;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Request\Request\Directive\Payload;
use \PHPUnit\Framework\TestCase;

/**
 * Class PayloadTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class PayloadTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testPayload() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../../../Fixtures/DiscoveryRequest.json'), true);
		$payload = new Payload($fixture['request']['directive']['payload']);

		$this->assertEquals('BearerToken', $payload->getScope()->getType());
        $this->assertEquals('access-token-send-by-skill', $payload->getScope()->getToken());

        $payload->extractValue(['brightness' => 20], 'Alexa.BrightnessController', 'SetBrightness');
        $this->assertEquals(20, $payload->getValue());

        $payload->extractValue(['mute' => true], 'Alexa.Speaker', 'SetMute');
        $this->assertEquals(true, $payload->getValue());

        $payload->extractValue(['input' => 'AUX'], 'Alexa.InputController', 'SelectInput');
        $this->assertEquals('AUX', $payload->getValue());

        $value = ['channel' => ['number' => 15]];
        $payload->extractValue($value, 'Alexa.ChannelController', 'ChangeChannel');
        $this->assertEquals(15, $payload->getValue()->getNumber());

        $value = ['color' => ['hue' => 180, 'saturation' => 1, 'brightness' => 1]];
        $payload->extractValue($value, 'Alexa.ColorController', 'SetColor');
        $this->assertEquals(180, $payload->getValue()->getHue());

        $value = ['targetSetpointDelta' => ['value' => 25, 'scale' => 'CELSIUS']];
        $payload->extractValue($value, 'Alexa.ThermostatController', 'AdjustTargetTemperature');
        $this->assertEquals(25, $payload->getValue()->getValue());

        $value = ['cameraStreamConfigurations' => [['protocols' => ['Protocol']]]];
        $payload->extractValue($value, 'Alexa.CameraStreamController', 'InitializeCameraStreams');
        /** @var CameraStreamConfiguration $config */
        $config = $payload->getValue()[0];
        $this->assertEquals(['Protocol'], $config->getProtocols());
	}
}
