<?php

namespace Tests\Alexa\Response\Directives\GadgetController;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\GadgetController\Animations;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\GadgetController\Parameters;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\GadgetController\Sequence;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\GadgetController\SetLight;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class GadgetControllerTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class GadgetControllerTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testSequence() {
		$test   = new Sequence('33ccff', 100, true);
		$expect = [
			'durationMs' => 100,
			'blend'      => true,
			'color'      => '33ccff',
		];

		$this->assertEquals($expect, $test->render());
	}

	/**
	 * @group custom-skill
	 */
	public function testSequenceException1() {
		$this->expectException(InvalidArgumentException::class);
		new Sequence('N0C0LR');
	}

	/**
	 * @group custom-skill
	 */
	public function testSequenceException2() {
		$this->expectException(InvalidArgumentException::class);
		new Sequence('33ccff', -1);
	}

	/**
	 * @group custom-skill
	 */
	public function testAnimations() {
		$test   = new Animations([new Sequence()]);
		$expect = [
			'repeat'       => 1,
			'targetLights' => ['1'],
			'sequence'     => [
				[
					'durationMs' => 1000,
					'blend'      => false,
					'color'      => 'FFFFFF',
				],
			],
		];

		$this->assertEquals($expect, $test->render());
	}

	/**
	 * @group custom-skill
	 */
	public function testAnimationsException1() {
		$this->expectException(InvalidArgumentException::class);
		new Animations([new Sequence()], -1);
	}

	/**
	 * @group custom-skill
	 */
	public function testAnimationsException2() {
		$steps = [];
		for($i = 0; $i < 40; $i++) {
			array_push($steps, new Sequence());
		}

		$this->expectException(InvalidArgumentException::class);
		new Animations($steps);
	}

	/**
	 * @group custom-skill
	 */
	public function testAnimationsException3() {
		$test = new Animations();
		$this->expectException(InvalidArgumentException::class);
		$test->render();
	}

	/**
	 * @group custom-skill
	 */
	public function testParameters() {
		$test   = new Parameters('buttonDown', 10, new Animations([new Sequence()]));
		$expect = [
			'triggerEvent'       => 'buttonDown',
			'triggerEventTimeMs' => 10,
			'animations'         => [
				'repeat'       => 1,
				'targetLights' => ['1'],
				'sequence'     => [
					[
						'durationMs' => 1000,
						'blend'      => false,
						'color'      => 'FFFFFF',
					],
				],
			],
		];

		$this->assertEquals($expect, $test->render());
	}

	/**
	 * @group custom-skill
	 */
	public function testParametersException1() {
		$this->expectException(InvalidArgumentException::class);
		new Parameters('buttonAnywhere', 10, new Animations());
	}

	/**
	 * @group custom-skill
	 */
	public function testParametersException2() {
		$this->expectException(InvalidArgumentException::class);
		new Parameters('buttonUp', -10, new Animations());
	}

	/**
	 * @group custom-skill
	 */
	public function testSetLight() {
		$parameters = new Parameters('buttonDown', 10, new Animations([new Sequence()]));
		$test       = new SetLight($parameters, ['myGadget1', 'myGadget2']);
		$expect     = [
			'type'          => 'GadgetController.SetLight',
			'version'       => 1,
			'parameters'    => [
				'triggerEvent'       => 'buttonDown',
				'triggerEventTimeMs' => 10,
				'animations'         => [
					'repeat'       => 1,
					'targetLights' => ['1'],
					'sequence'     => [
						[
							'durationMs' => 1000,
							'blend'      => false,
							'color'      => 'FFFFFF',
						],
					],
				],
			],
			'targetGadgets' => [
				'myGadget1', 'myGadget2'
			],
		];

		$this->assertEquals($expect, $test->render());
	}
}
