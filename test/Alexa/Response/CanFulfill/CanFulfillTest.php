<?php

namespace Tests\Alexa\Response\CanFulfill;

use \InternetOfVoice\LibVoice\Alexa\Response\CanFulfill\CanFulfillIntent;
use \InternetOfVoice\LibVoice\Alexa\Response\CanFulfill\Slot;
use \PHPUnit\Framework\TestCase;

/**
 * Class CanFulfillTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class CanFulfillTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testCanFulfillIntent() {
		$intent = new CanFulfillIntent('YES');
		$intent->addSlot('slotName1', new Slot('MAYBE', 'YES'));
		$this->assertEquals('YES', $intent->getCanFulfill());
		$this->assertEquals('MAYBE', $intent->getSlot('slotName1')->getCanUnderstand());
		$this->assertEquals('YES', $intent->getSlot('slotName1')->getCanFulfill());
		$this->assertArrayHasKey('slotName1', $intent->getSlots());

		$intent->setSlots(['slotName2' => new Slot('NO', 'NO')]);
		$this->assertEquals('NO', $intent->getSlot('slotName2')->getCanUnderstand());
		$this->assertEquals('NO', $intent->getSlot('slotName2')->getCanFulfill());

		$expect = [
			'canFulfill' => 'YES',
			'slots' => [
				'slotName2' => [
					'canUnderstand' => 'NO',
					'canFulfill' => 'NO',
				],
			],
		];
		$this->assertEquals($expect, $intent->render());
	}

	/**
	 * @group custom-skill
	 */
	public function testCanFulfillException() {
		$this->expectException('\InvalidArgumentException');
		new CanFulfillIntent('PERHAPS');
	}

	/**
	 * @group custom-skill
	 */
	public function testSlotException1() {
		$this->expectException('\InvalidArgumentException');
		new Slot('PERHAPS', 'ABSOLUTELY-NOT');
	}

	/**
	 * @group custom-skill
	 */
	public function testSlotException2() {
		$this->expectException('\InvalidArgumentException');
		new Slot('YES', 'ABSOLUTELY-NOT');
	}
}
