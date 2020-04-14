<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\GadgetController;

use \InvalidArgumentException;

/**
 * Class Animations
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Animations {
	/** @var int MIN_REPEAT */
	const MIN_REPEAT = 0;

	/** @var int MAX_REPEAT */
	const MAX_REPEAT = 255;

	/** @var int $repeat */
	protected $repeat = 1;

	/** @var array $targetLights */
	protected $targetLights = ['1'];

	/** @var Sequence[] $sequence */
	protected $sequence = [];


	/**
	 * @param Sequence[] $sequence
	 * @param int        $repeat
	 * @param array      $targetLights
	 */
	public function __construct(array $sequence = [], int $repeat = 1, array $targetLights = ['1']) {
		$this->setSequence($sequence);
		$this->setRepeat($repeat);
		$this->setTargetLights($targetLights);
	}


	/**
	 * @return int
	 */
	public function getRepeat(): int {
		return $this->repeat;
	}

	/**
	 * @param  int $repeat
	 *
	 * @return Animations
	 * @throws InvalidArgumentException
	 */
	public function setRepeat(int $repeat): Animations {
		if(!is_int($repeat) || $repeat < self::MIN_REPEAT || $repeat > self::MAX_REPEAT) {
			throw new InvalidArgumentException('Repeat must be a number between ' . self::MIN_REPEAT . ' and ' . self::MAX_REPEAT);
		}

		$this->repeat = $repeat;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getTargetLights(): array {
		return $this->targetLights;
	}

	/**
	 * @param  array $targetLights
	 *
	 * @return Animations
	 */
	public function setTargetLights(array $targetLights): Animations {
		$this->targetLights = [];
		foreach($targetLights as $targetLight) {
			$this->addTargetLight($targetLight);
		}

		return $this;
	}

	/**
	 * @param  string $targetLight
	 *
	 * @return Animations
	 */
	public function addTargetLight(string $targetLight): Animations {
		array_push($this->targetLights, $targetLight);

		return $this;
	}

	/**
	 * @return Sequence[]
	 */
	public function getSequence(): array {
		return $this->sequence;
	}

	/**
	 * @param  Sequence[] $sequence
	 *
	 * @return Animations
	 */
	public function setSequence(array $sequence): Animations {
		$this->sequence = [];
		foreach($sequence as $sequenceStep) {
			$this->addSequenceStep($sequenceStep);
		}

		return $this;
	}

	/**
	 * @param  Sequence $sequenceStep
	 *
	 * @return Animations
	 * @throws InvalidArgumentException
	 */
	public function addSequenceStep(Sequence $sequenceStep): Animations {
		$lights = count($this->getTargetLights());
		$max    = 38 - ($lights * 3);
		if(count($this->sequence) == $max) {
			throw new InvalidArgumentException('A maximum of ' . $max . 'sequence steps is allowed for ' . $lights . ' targetLights.');
		}

		array_push($this->sequence, $sequenceStep);

		return $this;
	}


	/**
	 * @return array
	 * @throws InvalidArgumentException
	 */
	public function render(): array {
		if(!count($this->getSequence())) {
			throw new InvalidArgumentException('At least one sequence step is required for an Animation.');
		}

		$rendered = [
			'repeat'       => $this->getRepeat(),
			'targetLights' => $this->getTargetLights(),
			'sequence'     => [],
		];

		foreach($this->getSequence() as $sequenceStep) {
			array_push($rendered['sequence'], $sequenceStep->render());
		}

		return $rendered;
	}
}
