<?php

namespace Tests\Alexa\Response\Directives\GameEngine;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\GameEngine\Event;
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
}
