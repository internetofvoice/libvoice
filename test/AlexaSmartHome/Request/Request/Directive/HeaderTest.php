<?php

namespace Tests\AlexaSmartHome\Request\Request\Directive;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Request\Request\Directive\Header;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class HeaderTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class HeaderTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testHeader() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../../../Fixtures/DiscoveryRequest.json'), true);
		$header  = new Header($fixture['request']['directive']['header']);

		$this->assertEquals('Alexa.Discovery', $header->getNamespace());
		$this->assertEquals('Discover', $header->getName());
		$this->assertEquals('3', $header->getPayloadVersion());
		$this->assertRegExp('/^[0-9a-zA-Z-]{36}$/', $header->getMessageId());
	}

	/**
	 * @group smarthome
	 */
	public function testMissingNamespace() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../../../Fixtures/DiscoveryRequest.json'), true);
		$header  = $fixture['request']['directive']['header'];
		unset($header['namespace']);

		$this->expectException(InvalidArgumentException::class);
		new Header($header);
	}

	/**
	 * @group smarthome
	 */
	public function testMissingName() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../../../Fixtures/DiscoveryRequest.json'), true);
		$header  = $fixture['request']['directive']['header'];
		unset($header['name']);

		$this->expectException(InvalidArgumentException::class);
		new Header($header);
	}

	/**
	 * @group smarthome
	 */
	public function testMissingPayloadVersion() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../../../Fixtures/DiscoveryRequest.json'), true);
		$header  = $fixture['request']['directive']['header'];
		unset($header['payloadVersion']);

		$this->expectException(InvalidArgumentException::class);
		new Header($header);
	}

	/**
	 * @group smarthome
	 */
	public function testMissingMessageId() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../../../Fixtures/DiscoveryRequest.json'), true);
		$header  = $fixture['request']['directive']['header'];
		unset($header['messageId']);

		$this->expectException(InvalidArgumentException::class);
		new Header($header);
	}
}
