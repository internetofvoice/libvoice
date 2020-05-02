<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\GadgetController;

use \InvalidArgumentException;

/**
 * Class Sequence
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Sequence {
	/** @var int MIN_DURATION_MS */
	const MIN_DURATION_MS = 1;

	/** @var int MAX_DURATION_MS */
	const MAX_DURATION_MS = 65535;

	/** @var int $durationMs */
	protected $durationMs = 1000;

	/** @var bool $blend */
	protected $blend = false;

	/** @var string $color */
	protected $color = 'FFFFFF';


	/**
	 * @param string $color
	 * @param int    $durationMs
	 * @param bool   $blend
	 */
	public function __construct(string $color = 'FFFFFF', int $durationMs = 1000, bool $blend = false) {
		$this->setDurationMs($durationMs);
		$this->setBlend($blend);
		$this->setColor($color);
	}


	/**
	 * @return int
	 */
	public function getDurationMs(): int {
		return $this->durationMs;
	}

	/**
	 * @param  int $durationMs
	 *
	 * @return Sequence
	 * @throws InvalidArgumentException
	 */
	public function setDurationMs(int $durationMs): Sequence {
		if(!is_int($durationMs) || $durationMs < self::MIN_DURATION_MS || $durationMs > self::MAX_DURATION_MS) {
			throw new InvalidArgumentException('DurationMs must be a number between ' . self::MIN_DURATION_MS . ' and ' . self::MAX_DURATION_MS);
		}

		$this->durationMs = $durationMs;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function getBlend(): bool {
		return $this->blend;
	}

	/**
	 * @param  bool $blend
	 *
	 * @return Sequence
	 */
	public function setBlend(bool $blend): Sequence {
		$this->blend = boolval($blend);

		return $this;
	}

	/**
	 * @return string
	 */
	public function getColor(): string {
		return $this->color;
	}

	/**
	 * @param  string $color  Hexadecimal RGB value without leading hash symbol (i.e. 33CC66)
	 *
	 * @return Sequence
	 */
	public function setColor(string $color): Sequence {
		if(!preg_match('/^[0-9a-fA-F]{6}$/', $color)) {
			throw new InvalidArgumentException('Color must be a hexadecimal RGB value without hash symbol (i.e. 33CC66)');
		}

		$this->color = $color;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'durationMs' => $this->getDurationMs(),
			'blend'      => $this->getBlend(),
			'color'      => $this->getColor(),
		];
	}
}
