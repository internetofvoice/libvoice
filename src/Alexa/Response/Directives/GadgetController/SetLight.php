<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\GadgetController;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AbstractDirective;
use \InvalidArgumentException;

/**
 * Class SetLight
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class SetLight extends AbstractDirective {
	/** @var int MIN_VERSION */
	const MIN_VERSION = 1;

	/** @var int MAX_VERSION */
	const MAX_VERSION = 1;

	/** @var int $version */
	protected $version = 1;

	/** @var array $targetGadgets */
	protected $targetGadgets = [];

	/** @var Parameters $parameters */
	protected $parameters;


	/**
	 * @param Parameters $parameters
	 * @param array      $targetGadgets
	 */
	public function __construct(Parameters $parameters, array $targetGadgets = []) {
		parent::__construct();

		$this->type = 'GadgetController.SetLight';
		$this->setParameters($parameters);
		$this->setTargetGadgets($targetGadgets);
	}


	/**
	 * @return int
	 */
	public function getVersion(): int {
		return $this->version;
	}

	/**
	 * @param  int $version
	 *
	 * @return SetLight
	 * @throws InvalidArgumentException
	 */
	public function setVersion(int $version): SetLight {
		if(!is_int($version) || $version < self::MIN_VERSION || $version > self::MAX_VERSION) {
			throw new InvalidArgumentException('TriggerEventTimeMs must be a number between ' . self::MIN_VERSION . ' and ' . self::MAX_VERSION);
		}

		$this->version = $version;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getTargetGadgets(): array {
		return $this->targetGadgets;
	}

	/**
	 * @param  array $targetGadgets
	 *
	 * @return SetLight
	 */
	public function setTargetGadgets(array $targetGadgets): SetLight {
		$this->targetGadgets = [];
		foreach($targetGadgets as $targetGadget) {
			$this->addTargetGadget($targetGadget);
		}

		return $this;
	}

	/**
	 * @param  string $targetGadget
	 *
	 * @return SetLight
	 */
	public function addTargetGadget(string $targetGadget): SetLight {
		array_push($this->targetGadgets, $targetGadget);

		return $this;
	}

	/**
	 * @return Parameters
	 */
	public function getParameters(): Parameters {
		return $this->parameters;
	}

	/**
	 * @param  Parameters $parameters
	 *
	 * @return SetLight
	 */
	public function setParameters(Parameters $parameters): SetLight {
		$this->parameters = $parameters;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		$result = [
			'type'       => $this->getType(),
			'version'    => $this->getVersion(),
			'parameters' => $this->getParameters()->render(),
		];

		if($targetGadgets = $this->getTargetGadgets()) {
			$result['targetGadgets'] = $targetGadgets;
		}

		return $result;
	}
}
