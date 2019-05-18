<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\GameEngine;

use \InvalidArgumentException;

/**
 * Class Pattern
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Pattern {
	const ACTIONS = ['down', 'up', 'silence'];

	/** @var array $gadgetIds */
	protected $gadgetIds = [];

	/** @var array $colors */
	protected $colors = [];

	/** @var string $action */
	protected $action = '';

	/** @var int $repeat */
	protected $repeat = 0;


	/**
	 * @param string $action
	 */
	public function __construct($action = '') {
		$this->setAction($action);
	}


	/**
	 * @return array
	 */
	public function getGadgetIds() {
		return $this->gadgetIds;
	}

	/**
	 * @param  array $gadgetIds
	 *
	 * @return Pattern
	 */
	public function setGadgetIds($gadgetIds) {
		$this->gadgetIds = [];
		foreach($gadgetIds as $gadgetId) {
			$this->addGadgetId($gadgetId);
		}

		return $this;
	}

	/**
	 * @param  string $gadgetId
	 *
	 * @return Pattern
	 */
	public function addGadgetId($gadgetId) {
		array_push($this->gadgetIds, $gadgetId);

		return $this;
	}

	/**
	 * @return array
	 */
	public function getColors() {
		return $this->colors;
	}

	/**
	 * @param  array $colors
	 *
	 * @return Pattern
	 */
	public function setColors($colors) {
		$this->colors = [];
		foreach($colors as $color) {
			$this->addColor($color);
		}

		return $this;
	}

	/**
	 * @param  string $color
	 *
	 * @return Pattern
	 * @throws InvalidArgumentException
	 */
	public function addColor($color) {
		if(!preg_match('/^[0-9a-fA-F]{6}$/', $color)) {
			throw new InvalidArgumentException('Color must be a hexadecimal RGB value without hash symbol (i.e. 33CC66)');
		}

		array_push($this->colors, $color);

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAction() {
		return $this->action;
	}

	/**
	 * @param  string $action
	 *
	 * @return Pattern
	 * @throws InvalidArgumentException
	 */
	public function setAction($action) {
		if(!empty($action) && !in_array($action, self::ACTIONS)) {
			throw new InvalidArgumentException('Action must be one of ' . implode(', ', self::ACTIONS) . ' or an empty string.');
		}

		$this->action = $action;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getRepeat() {
		return $this->repeat;
	}

	/**
	 * @param  int $repeat
	 *
	 * @return Pattern
	 */
	public function setRepeat($repeat) {
		$this->repeat = intval(abs($repeat));

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		$rendered = [];

		if($gadgetIds = $this->getGadgetIds()) {
			$rendered['gadgetIds'] = $gadgetIds;
		}

		if($colors = $this->getColors()) {
			$rendered['colors'] = $colors;
		}

		if($action = $this->getAction()) {
			$rendered['action'] = $action;
		}

		if($repeat = $this->getRepeat()) {
			$rendered['repeat'] = $repeat;
		}

		return $rendered;
	}
}
