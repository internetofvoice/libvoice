<?php

namespace Tests\Alexa\Request\Request;

use \InternetOfVoice\LibVoice\Alexa\Request\Request\LaunchRequest;
use \PHPUnit\Framework\TestCase;

/**
 * Class LaunchRequestTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class LaunchRequestTest extends TestCase {
	/**
	 * testLaunchRequest
	 */
	public function testLaunchRequest() {
		$fixture = [
			'type' => 'LaunchRequest',
			'requestId' => 'amzn1.echo-api.request.83120192-c5cd-4788-9109-d251e01bb962',
			'timestamp' => '2017-09-18T09:24:55Z',
			'locale' => 'de-DE',
		];

		$request = new LaunchRequest($fixture);

		// Request
		$this->assertEquals('LaunchRequest', $request->getType());
		$this->assertStringStartsWith('amzn1.echo-api.request.', $request->getRequestId());
		$this->assertEquals('2017-09-18 09:24:55', $request->getTimestamp()->format('Y-m-d H:i:s'));
		$this->assertEquals('de-DE', $request->getLocale());
	}
}
