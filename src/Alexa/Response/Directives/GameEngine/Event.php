<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\GameEngine;

use \InvalidArgumentException;

/**
 * Class Event
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Event {
	const REPORTS = ['history', 'matches', 'nothing'];

	const MIN_MAXIMUM_INVOCATIONS = 1;
	const MAX_MAXIMUM_INVOCATIONS = 2048;

	const MIN_TRIGGER_TIME_MILLISECONDS = 0;
	const MAX_TRIGGER_TIME_MILLISECONDS = 300000;

	/** @var string $id */
	protected $id;

	/** @var array $meets */
	protected $meets = [];

	/** @var array $fails */
	protected $fails = [];

	/** @var string $reports */
	protected $reports = '';

	/** @var bool $shouldEndInputHandler */
	protected $shouldEndInputHandler = true;

	/** @var int $maximumInvocations */
	protected $maximumInvocations = -1;

	/** @var int $triggerTimeMilliseconds */
	protected $triggerTimeMilliseconds = -1;


	/**
	 * @param string $id
	 * @param array  $meets
	 * @param bool   $shouldEndInputHandler
	 * @param string $reports
	 */
	public function __construct($id, $meets, $shouldEndInputHandler, $reports) {
		$this->setId($id);
		$this->setMeets($meets);
		$this->setShouldEndInputHandler($shouldEndInputHandler);
		$this->setReports($reports);
	}


	/**
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param  string $id
	 *
	 * @return Event
	 */
	public function setId($id) {
		$this->id = $id;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getMeets() {
		return $this->meets;
	}

	/**
	 * @param  array $meets
	 *
	 * @return Event
	 */
	public function setMeets($meets) {
		$this->meets = [];
		foreach($meets as $meet) {
			$this->addMeet($meet);
		}

		return $this;
	}

	/**
	 * @param  string $meet
	 *
	 * @return Event
	 */
	public function addMeet($meet) {
		array_push($this->meets, $meet);

		return $this;
	}

	/**
	 * @return array
	 */
	public function getFails() {
		return $this->fails;
	}

	/**
	 * @param  array $fails
	 *
	 * @return Event
	 */
	public function setFails($fails) {
		$this->fails = [];
		foreach($fails as $fail) {
			$this->addFail($fail);
		}

		return $this;
	}

	/**
	 * @param  string $fail
	 *
	 * @return Event
	 */
	public function addFail($fail) {
		array_push($this->fails, $fail);

		return $this;
	}

	/**
	 * @return string
	 */
	public function getReports() {
		return $this->reports;
	}

	/**
	 * @param  string $reports
	 *
	 * @return Event
	 */
	public function setReports($reports) {
		if(!empty($reports) && !in_array($reports, self::REPORTS)) {
			throw new InvalidArgumentException('Reports must be one of ' . implode(', ', self::REPORTS) . ' or an empty string.');
		}

		$this->reports = $reports;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function getShouldEndInputHandler() {
		return $this->shouldEndInputHandler;
	}

	/**
	 * @param  bool $shouldEndInputHandler
	 *
	 * @return Event
	 */
	public function setShouldEndInputHandler($shouldEndInputHandler) {
		$this->shouldEndInputHandler = boolval($shouldEndInputHandler);

		return $this;
	}

	/**
	 * @return int
	 */
	public function getMaximumInvocations() {
		return $this->maximumInvocations;
	}

	/**
	 * @param  int $maximumInvocations
	 *
	 * @return Event
	 * @throws InvalidArgumentException
	 */
	public function setMaximumInvocations($maximumInvocations) {
		if(!is_int($maximumInvocations) || $maximumInvocations < self::MIN_MAXIMUM_INVOCATIONS || $maximumInvocations > self::MAX_MAXIMUM_INVOCATIONS) {
			if($maximumInvocations != -1) {
				throw new InvalidArgumentException('MaximumInvocations must be a number between ' . self::MIN_MAXIMUM_INVOCATIONS . ' and ' . self::MAX_MAXIMUM_INVOCATIONS . ' or -1 to disable.');
			}
		}

		$this->maximumInvocations = $maximumInvocations;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getTriggerTimeMilliseconds() {
		return $this->triggerTimeMilliseconds;
	}

	/**
	 * @param  int $triggerTimeMilliseconds
	 *
	 * @return Event
	 * @throws InvalidArgumentException
	 */
	public function setTriggerTimeMilliseconds($triggerTimeMilliseconds) {
		if(!is_int($triggerTimeMilliseconds) || $triggerTimeMilliseconds < self::MIN_TRIGGER_TIME_MILLISECONDS || $triggerTimeMilliseconds > self::MAX_TRIGGER_TIME_MILLISECONDS) {
			if($triggerTimeMilliseconds != -1) {
				throw new InvalidArgumentException('TriggerTimeMilliseconds must be a number between ' . self::MIN_TRIGGER_TIME_MILLISECONDS . ' and ' . self::MAX_TRIGGER_TIME_MILLISECONDS . ' or -1 to disable.');
			}
		}

		$this->triggerTimeMilliseconds = $triggerTimeMilliseconds;

		return $this;
	}


	/**
	 * @return array
	 * @throws InvalidArgumentException
	 */
	public function render() {
		if($this->getMaximumInvocations() != -1 && $this->getTriggerTimeMilliseconds() != -1) {
			throw new InvalidArgumentException('Setting maximumInvocations and triggerTimeMilliseconds simultaneously is not allowed.');
		}

		$rendered = [
			'meets'                 => $this->getMeets(),
			'shouldEndInputHandler' => $this->getShouldEndInputHandler(),
		];

		if($fails = $this->getFails()) {
			$rendered['fails'] = $fails;
		}

		if($reports = $this->getReports()) {
			$rendered['reports'] = $reports;
		}

		if($maximumInvocations = $this->getMaximumInvocations() != -1) {
			$rendered['maximumInvocations'] = $maximumInvocations;
		}

		if($triggerTimeMilliseconds = $this->getTriggerTimeMilliseconds() != -1) {
			$rendered['triggerTimeMilliseconds'] = $triggerTimeMilliseconds;
		}

		return $rendered;
	}
}
