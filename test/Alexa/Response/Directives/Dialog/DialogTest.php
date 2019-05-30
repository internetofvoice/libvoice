<?php

namespace Tests\Alexa\Response\Directives\Dialog;

use \InternetOfVoice\LibVoice\Alexa\Request\Request\Intent\Intent;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Dialog\ConfirmIntent;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Dialog\ConfirmSlot;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Dialog\Delegate;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Dialog\ElicitSlot;
use \PHPUnit\Framework\TestCase;

/**
 * Class DialogTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class DialogTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testDialogs() {
		$dialog = new ConfirmIntent(new Intent());
		$this->assertInstanceOf(ConfirmIntent::class, $dialog);
		$this->assertInstanceOf(Intent::class, $dialog->getUpdatedIntent());
		$this->assertEquals('Dialog.ConfirmIntent', $dialog->getType());

		$expect = [
			'type' => 'Dialog.ConfirmIntent',
			'updatedIntent' => [
				'name' => null,
				'confirmationStatus' => null,
			],
		];

		$this->assertEquals($expect, $dialog->render());

		$dialog = new ConfirmSlot(new Intent());
		$dialog->setSlotToConfirm('mySlot');
		$this->assertInstanceOf(ConfirmSlot::class, $dialog);
		$this->assertInstanceOf(Intent::class, $dialog->getUpdatedIntent());
		$this->assertEquals('Dialog.ConfirmSlot', $dialog->getType());
		$this->assertEquals('mySlot', $dialog->getSlotToConfirm());

		$expect = [
			'type' => 'Dialog.ConfirmSlot',
			'slotToConfirm' => 'mySlot',
			'updatedIntent' => [
				'name' => null,
				'confirmationStatus' => null,
			],
		];

		$this->assertEquals($expect, $dialog->render());

		$dialog = new Delegate(new Intent());
		$this->assertInstanceOf(Delegate::class, $dialog);
		$this->assertInstanceOf(Intent::class, $dialog->getUpdatedIntent());
		$this->assertEquals('Dialog.Delegate', $dialog->getType());

		$dialog = new ElicitSlot(new Intent());
		$dialog->setSlotToElicit('mySlot');
		$this->assertInstanceOf(ElicitSlot::class, $dialog);
		$this->assertInstanceOf(Intent::class, $dialog->getUpdatedIntent());
		$this->assertEquals('Dialog.ElicitSlot', $dialog->getType());
		$this->assertEquals('mySlot', $dialog->getSlotToElicit());

		$expect = [
			'type' => 'Dialog.ElicitSlot',
			'slotToElicit' => 'mySlot',
			'updatedIntent' => [
				'name' => null,
				'confirmationStatus' => null,
			],
		];

		$this->assertEquals($expect, $dialog->render());
	}
}
