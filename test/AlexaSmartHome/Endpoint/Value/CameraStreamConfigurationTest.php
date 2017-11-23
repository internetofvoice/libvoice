<?php

namespace Tests\AlexaSmartHome\Endpoint\Value;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\CameraStreamConfiguration;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\Resolution;
use \PHPUnit\Framework\TestCase;

/**
 * Class CameraStreamConfigurationTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class CameraStreamConfigurationTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testCameraStreamConfigurationCreate() {
        $csConfig = CameraStreamConfiguration::create()
            ->setProtocols(['RTSP'])
            ->setResolutions([new Resolution(1920, 1080), new Resolution(1280, 720)])
            ->setAuthorizationTypes(['BASIC'])
            ->setVideoCodecs(['H264', 'MPEG2'])
            ->setAudioCodecs(['G711'])
        ;

		$expect = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/CameraStreamConfiguration.json'), true);
		$this->assertEquals($expect, $csConfig->render());
	}

    /**
     * @group smarthome
     */
    public function testCameraStreamConfigurationConstructor() {
        $csConfig = new CameraStreamConfiguration([
            'protocols' => ['RTSP'],
            'resolutions' => [new Resolution(1920, 1080), new Resolution(1280, 720)],
            'authorizationTypes' => ['BASIC'],
            'videoCodecs' => ['H264', 'MPEG2'],
            'audioCodecs' => ['G711'],
        ]);

        $expect = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/CameraStreamConfiguration.json'), true);
        $this->assertEquals($expect, $csConfig->render());
    }

    /**
     * @group smarthome
     */
    public function testInvalidAuthorizationType() {
        $this->expectException('InvalidArgumentException');
        CameraStreamConfiguration::create()->addAuthorizationType('INVALID');
    }

    /**
     * @group smarthome
     */
    public function testInvalidVideoCoded() {
        $this->expectException('InvalidArgumentException');
        CameraStreamConfiguration::create()->addVideoCodec('INVALID');
    }

    /**
     * @group smarthome
     */
    public function testInvalidAudioCodec() {
        $this->expectException('InvalidArgumentException');
        CameraStreamConfiguration::create()->addAudioCodec('INVALID');
    }
}
