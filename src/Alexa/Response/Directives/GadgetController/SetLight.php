<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\GadgetController;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AbstractDirective;
// use \InvalidArgumentException;

/**
 * Class SetLight
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class SetLight extends AbstractDirective {
	const MIN_VERSION = 1;
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
	public function __construct($parameters, $targetGadgets = []) {
		parent::__construct();

		$this->type = 'GadgetController.SetLight';
		$this->setParameters($parameters);
		$this->setTargetGadgets($targetGadgets);
	}


	/**
	 * @return int
	 */
	public function getVersion() {
		return $this->version;
	}

//	/**
//	 * @param  int $version
//	 *
//	 * @return SetLight
//	 * @throws InvalidArgumentException
//	 */
//	public function setVersion($version) {
//		if(!is_int($version) || $version < self::MIN_VERSION || $version > self::MAX_VERSION) {
//			throw new InvalidArgumentException('TriggerEventTimeMs must be a number between ' . self::MIN_VERSION . ' and ' . self::MAX_VERSION);
//		}
//
//		$this->version = $version;
//
//		return $this;
//	}

	/**
	 * @return array
	 */
	public function getTargetGadgets() {
		return $this->targetGadgets;
	}

	/**
	 * @param  array $targetGadgets
	 *
	 * @return SetLight
	 */
	public function setTargetGadgets($targetGadgets) {
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
	public function addTargetGadget($targetGadget) {
		array_push($this->targetGadgets, $targetGadget);

		return $this;
	}

	/**
	 * @return Parameters
	 */
	public function getParameters() {
		return $this->parameters;
	}

	/**
	 * @param  Parameters $parameters
	 *
	 * @return SetLight
	 */
	public function setParameters($parameters) {
		$this->parameters = $parameters;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
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
