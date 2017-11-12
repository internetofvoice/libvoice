<?php

namespace Tests\AlexaSmartHome\Request;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Request\Context;
use \PHPUnit\Framework\TestCase;

/**
 * Class ContextTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ContextTest extends TestCase {
	/**
	 * testContext
	 *
	 * @group smarthome
	 */
	public function testContext() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/Fixtures/DiscoveryRequest.json'), true);
		$context = new Context($fixture['context']);

		$this->assertEquals('ReConSkillAdapter', $context->getData()['functionName']);
	}
}
