<?php

namespace Tests\AlexaSmartHome\Endpoint\Value;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\Resolution;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class ResolutionTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ResolutionTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testResolutionCreate() {
        $resolution = Resolution::create()
	        ->setWidth(1920)
	        ->setHeight(1080)
        ;

		$expect = [
			'width' => 1920,
			'height' => 1080,
		];

		$this->assertEquals($expect, $resolution->render());
	}

    /**
     * @group smarthome
     */
    public function testMissingWidth() {
        $this->expectException(InvalidArgumentException::class);
        Resolution::createFromArray(['height' => 1080]);
    }

	/**
	 * @group smarthome
	 */
	public function testMissingHeight() {
		$this->expectException(InvalidArgumentException::class);
        Resolution::createFromArray(['width' => 1920]);
	}
}
