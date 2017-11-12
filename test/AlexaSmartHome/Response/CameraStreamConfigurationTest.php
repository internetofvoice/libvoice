<?php

namespace Tests\AlexaSmartHome\Response;

use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability\CameraStreamConfiguration;
use \PHPUnit\Framework\TestCase;

/**
 * Class CameraStreamConfigurationTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class CameraStreamConfigurationTest extends TestCase {
	/**
	 * testCameraStreamConfigurationCreate
	 *
	 * @group smarthome
	 */
	public function testCameraStreamConfigurationCreate() {
        $csConfig = CameraStreamConfiguration::create()
            ->setProtocols(['RTSP'])
            ->setResolutions([['width' => 1920, 'height' => 1080], ['width' => 1280, 'height' => 720]])
            ->setAuthorizationTypes(['BASIC'])
            ->setVideoCodecs(['H264', 'MPEG2'])
            ->setAudioCodecs(['G711'])
        ;

		$expect = json_decode(file_get_contents(__DIR__ . '/Fixtures/CameraStreamConfiguration.json'), true);
		$this->assertEquals($expect, $csConfig->render());
	}

    /**
     * testCameraStreamConfigurationConstructor
     *
     * @group smarthome
     */
    public function testCameraStreamConfigurationConstructor() {
        $csConfig = new CameraStreamConfiguration([
            'protocols' => ['RTSP'],
            'resolutions' => [['width' => 1920, 'height' => 1080], ['width' => 1280, 'height' => 720]],
            'authorizationTypes' => ['BASIC'],
            'videoCodecs' => ['H264', 'MPEG2'],
            'audioCodecs' => ['G711'],
        ]);

        $expect = json_decode(file_get_contents(__DIR__ . '/Fixtures/CameraStreamConfiguration.json'), true);
        $this->assertEquals($expect, $csConfig->render());
    }


    /**
     * testInvalidAuthorizationType
     *
     * @group smarthome
     */
    public function testInvalidAuthorizationType() {
        $this->expectException('InvalidArgumentException');
        CameraStreamConfiguration::create()->addAuthorizationType('INVALID');
    }

    /**
     * testInvalidVideoCoded
     *
     * @group smarthome
     */
    public function testInvalidVideoCoded() {
        $this->expectException('InvalidArgumentException');
        CameraStreamConfiguration::create()->addVideoCodec('INVALID');
    }

    /**
     * testInvalidAudioCodec
     *
     * @group smarthome
     */
    public function testInvalidAudioCodec() {
        $this->expectException('InvalidArgumentException');
        CameraStreamConfiguration::create()->addAudioCodec('INVALID');
    }
}
