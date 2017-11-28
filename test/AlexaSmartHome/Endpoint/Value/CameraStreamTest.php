<?php

namespace Tests\AlexaSmartHome\Endpoint\Value;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\CameraStream;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\Resolution;
use \PHPUnit\Framework\TestCase;

/**
 * Class CameraStreamTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class CameraStreamTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testCameraStreamCreate() {
        $cameraStream = CameraStream::create()
            ->setUri('rtsp://username:password@link.to.video:443/feed1.mp4')
            ->setExpirationTime(new \DateTime('2017-02-03 16:20:50'))
            ->setIdleTimeoutSeconds(30)
            ->setProtocol('RTSP')
            ->setResolution(new Resolution(1920, 1080))
            ->setAuthorizationType('BASIC')
            ->setVideoCodec('H264')
            ->setAudioCodec('AAC')
        ;

		$expect = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/CameraStream.json'), true);
		$this->assertEquals($expect, $cameraStream->render());
	}

    /**
     * @group smarthome
     */
    public function testCameraStreamConstructor() {
        $cameraStream = new CameraStream([
            'uri' => 'rtsp://username:password@link.to.video:443/feed1.mp4',
            'expirationTime' => '2017-02-03 16:20:50',
            'idleTimeoutSeconds' => 30,
            'protocol' => 'RTSP',
            'resolution' => ['width' => 1920, 'height' => 1080],
            'authorizationType' => 'BASIC',
            'videoCodec' => 'H264',
            'audioCodec' => 'AAC',
        ]);

        $expect = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/CameraStream.json'), true);
        $this->assertEquals($expect, $cameraStream->render());
    }

    /**
     * @group smarthome
     */
    public function testCameraStreamCreateFromArray() {
        $cameraStream = CameraStream::createFromArray([
            'uri' => 'rtsp://username:password@link.to.video:443/feed1.mp4',
            'expirationTime' => '2017-02-03 16:20:50',
            'idleTimeoutSeconds' => 30,
            'protocol' => 'RTSP',
            'resolution' => ['width' => 1920, 'height' => 1080],
            'authorizationType' => 'BASIC',
            'videoCodec' => 'H264',
            'audioCodec' => 'AAC',
        ]);

        $expect = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/CameraStream.json'), true);
        $this->assertEquals($expect, $cameraStream->render());
        $this->assertEquals(new \DateTime('2017-02-03 16:20:50'), $cameraStream->getExpirationTime());
    }

    /**
     * @group smarthome
     */
    public function testInvalidAuthorizationType() {
        $this->expectException('InvalidArgumentException');
        CameraStream::create()->setAuthorizationType('INVALID');
    }

    /**
     * @group smarthome
     */
    public function testInvalidVideoCoded() {
        $this->expectException('InvalidArgumentException');
        CameraStream::create()->setVideoCodec('INVALID');
    }

    /**
     * @group smarthome
     */
    public function testInvalidAudioCodec() {
        $this->expectException('InvalidArgumentException');
        CameraStream::create()->setAudioCodec('INVALID');
    }

    /**
     * @group smarthome
     */
    public function testInvalidExpirationTime() {
        $this->expectException('InvalidArgumentException');
        CameraStream::create()->setExpirationTime(null);
    }
}
