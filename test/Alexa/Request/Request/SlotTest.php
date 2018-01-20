<?php

namespace Tests\Alexa\Request\Request;

use \InternetOfVoice\LibVoice\Alexa\Request\Request\Intent\Slot;
use \PHPUnit\Framework\TestCase;

/**
 * Class SlotTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class SlotTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testSlotResolution() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/SlotResolutions.json'), true);
		$slot    = new Slot($fixture);

		// Slot
		$this->assertEquals('unit', $slot->getName());
		$this->assertEquals('stück', $slot->getValue());

		// Resolutions
		$resolutions = $slot->getResolutions()->getResolutionsPerAuthority();
		$this->assertTrue(is_array($resolutions));

		$resolution = $resolutions[0];
		$this->assertStringStartsWith('amzn1.er-authority.echo-sdk.amzn1.ask.skill.', $resolution->getAuthority());
		$this->assertEquals('ER_SUCCESS_MATCH', $resolution->getStatus()->getCode());

		$expect = [
			'93ef9aa6537da8aed9d768b7a360b817' => 'Stück',
			'bf0949eefdb8c318010e1c7aac16bd1c' => 'Stücke',
		];

		$this->assertEquals($expect, $resolution->getValuesAsArray());
	}
}
