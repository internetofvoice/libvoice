<?php

namespace Tests\AlexaSmartHome\Endpoint\Value;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\Cause;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class CauseTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class CauseTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testCreate() {
        $cause = new Cause('APP_INTERACTION');

		$expect = [
			'type' => 'APP_INTERACTION',
		];

		$this->assertEquals($expect, $cause->render());
	}

	/**
	 * @group smarthome
	 */
	public function testInvalidType() {
		$this->expectException(InvalidArgumentException::class);
		new Cause('INVALID_CAUSE');
	}
}
