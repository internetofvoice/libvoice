<?php

namespace Tests\Alexa\Request\Request;

use \InternetOfVoice\LibVoice\Alexa\Request\Request\IntentRequest;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\Intent\Intent;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\Intent\ResolutionPerAuthority;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\Intent\Resolutions;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\Intent\ResolutionStatus;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\Intent\ResolutionValue;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\Intent\Slot;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class IntentTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class IntentTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testIntent() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest2-Body.txt'), true);

		// Mock additional data
		$fixture['request']['dialogState'] = 'IDLE';
		$request = new IntentRequest($fixture['request']);

		// Request
		$this->assertEquals('IntentRequest', $request->getType());
		$this->assertStringStartsWith('amzn1.echo-api.request.', $request->getRequestId());
		$this->assertEquals('2017-09-18 09:24:55', $request->getTimestamp()->format('Y-m-d H:i:s'));
		$this->assertEquals('de-DE', $request->getLocale());
		$this->assertEquals('IDLE', $request->getDialogState());

		// Intent
		$intent = $request->getIntent();
		$this->assertEquals('ValuesAtIntent', $intent->getName());
		$this->assertEquals('NONE', $intent->getConfirmationStatus());

		$expect = [
			'day' => '2017-09-17',
			'time' => null,
		];

		$this->assertEquals($expect, $intent->getSlotsAsArray());

		// Slots
		$slot = $intent->getSlot('day');
		$this->assertEquals('day', $slot->getName());
		$this->assertEquals('2017-09-17', $slot->getValue());

		$slot = $intent->getSlot('time');
		$this->assertEquals('time', $slot->getName());
		$this->assertNull($slot->getValue());
		$this->assertEquals('NONE', $slot->getConfirmationStatus());

		$this->assertArrayHasKey('day', $intent->getSlots());
	}

	/**
	 * @group custom-skill
	 */
	public function testNoSlots() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest2-Body.txt'), true);

		// Mock additional data
		$fixture['request']['dialogState'] = 'IDLE';
		unset($fixture['request']['intent']['slots']);
		$request = new IntentRequest($fixture['request']);

		// Request
		$this->assertEquals([], $request->getIntent()->getSlotsAsArray());
	}

	/**
	 * @group custom-skill
	 */
	public function testSettableIntent() {
		$resolutionStatus = new ResolutionStatus();
		$resolutionStatus->setCode('ER_SUCCESS_MATCH');

		$resolutionValue = new ResolutionValue();
		$resolutionValue->setName('MyValue')->setId('MyID');

		$resolutionsPerAuthority = new ResolutionPerAuthority();
		$resolutionsPerAuthority->setAuthority('MyAuthority')->setStatus($resolutionStatus)->setValues([$resolutionValue]);

		$resolutions = new Resolutions();
		$resolutions->setResolutionsPerAuthority([$resolutionsPerAuthority]);

		$slot = new Slot();
		$slot->setName('MySlot')->setValue('MyValue')->setConfirmationStatus('NONE')->setSource('USER')->setResolutions($resolutions);

		$intent = new Intent();
		$intent->setName('MyIntent')->setConfirmationStatus('NONE')->setSlots([$slot]);

		$expect = [
			'name'               => 'MyIntent',
			'confirmationStatus' => 'NONE',
			'slots'              => [
				'MySlot' => [
					'name'               => 'MySlot',
					'value'              => 'MyValue',
					'confirmationStatus' => 'NONE',
					'resolutions'        => [
						'resolutionsPerAuthority' => [
							[
								'authority' => 'MyAuthority',
								'status'    => [
									'code' => 'ER_SUCCESS_MATCH',
								],
								'values'    => [
									[
										'value' => [
											'name' => 'MyValue',
											'id'   => 'MyID',
										],
									],
								],
							],
						],
					],
					'source'             => 'USER',
				],
			],
		];

		$this->assertEquals($expect, $intent->render());
	}

	/**
	 * @group custom-skill
	 */
	public function testSettableIntentException() {
		$intent = new Intent();
		$this->expectException(InvalidArgumentException::class);
		$intent->setConfirmationStatus('NO-VALID-STATUS');
	}

	/**
	 * @group custom-skill
	 */
	public function testSlotException() {
		$slot = new Slot();
		$this->expectException(InvalidArgumentException::class);
		$slot->setConfirmationStatus('NO-VALID-STATUS');
	}

	/**
	 * @group custom-skill
	 */
	public function testResolutionStatusException() {
		$resolutionStatus = new ResolutionStatus();
		$this->expectException(InvalidArgumentException::class);
		$resolutionStatus->setCode('NO-VALID-CODE');
	}
}
