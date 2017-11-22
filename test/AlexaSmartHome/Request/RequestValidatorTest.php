<?php

namespace Tests\AlexaSmartHome\Request;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Request\RequestValidator;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class RequestValidatorTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class RequestValidatorTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testSignatureValidation() {
		$data = '{"timestamp":"2017-11-21T15:47:48.798Z","data":{"key1":"value1","key2":"value2"}}';
		$signature = 'b732a57bd59fdf295da83410b5967bb1671de2e87f688146746ef12610f43315e13ea3641b1222ac043b837ccbae5b21c40fcd680c070c3e436768a3fcd9ba31';
		$secret = 'PRIVATE_KEY';
		$this->assertTrue(RequestValidator::validateSignature($data, $signature, $secret));

		$this->expectException(InvalidArgumentException::class);
		RequestValidator::validateSignature('RANDOM_DATA', 'RANDOM_SIGNATURE', 'RANDOM_SECRET');
	}

	/**
	 * @group smarthome
	 */
	public function testTimestampValidation() {
		$this->assertTrue(RequestValidator::validateTimestamp(gmdate('Y-m-d\TH:i:s\Z')));

		$this->expectException(InvalidArgumentException::class);
		RequestValidator::validateTimestamp('2017-01-01T00:00:00.000Z');
	}
}
