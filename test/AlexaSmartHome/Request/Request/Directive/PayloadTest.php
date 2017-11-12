<?php

namespace Tests\AlexaSmartHome\Request\Request\Directive;

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
	 * testPayload
	 *
	 * @group smarthome
	 */
	public function testPayload() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../../Fixtures/DiscoveryRequest.json'), true);
		$payload = new Payload($fixture['request']['directive']['payload']);

		$this->assertEquals('BearerToken', $payload->getScope()->getType());
        $this->assertEquals('access-token-send-by-skill', $payload->getScope()->getToken());
	}
}
