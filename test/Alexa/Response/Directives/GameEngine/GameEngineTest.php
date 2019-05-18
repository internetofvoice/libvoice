<?php

namespace Tests\Alexa\Response\Directives\GameEngine;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\GameEngine\DeviationRecognizer;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\GameEngine\Event;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\GameEngine\Pattern;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\GameEngine\PatternRecognizer;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\GameEngine\ProgressRecognizer;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class GameEngineTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class GameEngineTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testEvent() {
		$event = new Event('MyEvent', ['MyRecognizer1'], true, 'history');
		$event->addMeet('MyRecognizer2')->setFails(['MyFailingRecognizer1'])->setMaximumInvocations(3);
		$expect = [
			'meets'                 => ['MyRecognizer1', 'MyRecognizer2'],
			'shouldEndInputHandler' => true,
			'fails'                 => ['MyFailingRecognizer1'],
			'reports'               => 'history',
			'maximumInvocations'    => 3,
		];

		$this->assertEquals($expect, $event->render());
		$this->assertEquals('MyEvent', $event->getId());

		$event->setMaximumInvocations(-1)->setTriggerTimeMilliseconds(500);
		$expect = [
			'meets'                   => ['MyRecognizer1', 'MyRecognizer2'],
			'shouldEndInputHandler'   => true,
			'fails'                   => ['MyFailingRecognizer1'],
			'reports'                 => 'history',
			'triggerTimeMilliseconds' => 500,
		];

		$this->assertEquals($expect, $event->render());
	}

	/**
	 * @group custom-skill
	 */
	public function testEventException1() {
		$this->expectException(InvalidArgumentException::class);
		new Event('MyEvent', [], true, 'INVALID');
	}

	/**
	 * @group custom-skill
	 */
	public function testEventException2() {
		$event = new Event('MyEvent', [], true, 'history');
		$this->expectException(InvalidArgumentException::class);
		$event->setMaximumInvocations(-2);
	}

	/**
	 * @group custom-skill
	 */
	public function testEventException3() {
		$event = new Event('MyEvent', [], true, 'history');
		$this->expectException(InvalidArgumentException::class);
		$event->setTriggerTimeMilliseconds(-2);
	}

	/**
	 * @group custom-skill
	 */
	public function testEventException4() {
		$event = new Event('MyEvent', [], true, 'history');
		$event->setMaximumInvocations(3)->setTriggerTimeMilliseconds(500);
		$this->expectException(InvalidArgumentException::class);
		$event->render();
	}

	/**
	 * @group custom-skill
	 */
	public function testPattern() {
		$pattern = new Pattern('down');
		$pattern->setGadgetIds(['myGadget1'])->setColors(['AABBCC'])->setRepeat(3);
		$expect = [
			'gadgetIds' => ['myGadget1'],
			'colors'    => ['AABBCC'],
			'action'    => 'down',
			'repeat'    => 3,
		];

		$this->assertEquals($expect, $pattern->render());
	}

	/**
	 * @group custom-skill
	 */
	public function testPatternException1() {
		$pattern = new Pattern('down');
		$this->expectException(InvalidArgumentException::class);
		$pattern->addColor('NO-COLOR');
	}

	/**
	 * @group custom-skill
	 */
	public function testPatternException2() {
		$this->expectException(InvalidArgumentException::class);
		new Pattern('NO-ACTION');
	}

	/**
	 * @group custom-skill
	 */
	public function testDeviationRecognizer() {
		$recognizer = new DeviationRecognizer('MyID', 'MyRecognizer');

		$expect = [
			'type'       => 'deviation',
			'recognizer' => 'MyRecognizer',
		];

		$this->assertEquals($expect, $recognizer->render());
		$this->assertEquals('MyID', $recognizer->getId());
	}

	/**
	 * @group custom-skill
	 */
	public function testPatternRecognizer() {
		$recognizer = new PatternRecognizer('MyID', new Pattern('down'));
		$recognizer->setAnchor('start')->setFuzzy(true)->setGadgetIds(['myGadget1'])->setActions(['down']);

		$expect = [
			'type'      => 'match',
			'fuzzy'     => true,
			'pattern'   => [
				'action' => 'down',
			],
			'anchor'    => 'start',
			'gadgetIds' => ['myGadget1'],
			'actions'   => ['down'],
		];

		$this->assertEquals($expect, $recognizer->render());
		$this->assertEquals('MyID', $recognizer->getId());
	}

	/**
	 * @group custom-skill
	 */
	public function testPatternRecognizerException1() {
		$recognizer = new PatternRecognizer('MyID', new Pattern('down'));
		$this->expectException(InvalidArgumentException::class);
		$recognizer->setAnchor('NO-ANCHOR');
	}

	/**
	 * @group custom-skill
	 */
	public function testPatternRecognizerException2() {
		$recognizer = new PatternRecognizer('MyID', new Pattern('down'));
		$this->expectException(InvalidArgumentException::class);
		$recognizer->addAction('NO-ACTION');
	}

	/**
	 * @group custom-skill
	 */
	public function testProgressRecognizer() {
		$recognizer = new ProgressRecognizer('MyID1', 'MyRecognizer1', 50);

		$expect = [
			'type'       => 'progress',
			'recognizer' => 'MyRecognizer1',
			'completion' => 50,
		];

		$this->assertEquals($expect, $recognizer->render());
		$this->assertEquals('MyID1', $recognizer->getId());

		$this->expectException(InvalidArgumentException::class);
		$recognizer->setCompletion(200);
	}
}
