<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\GameEngine;

use \InvalidArgumentException;

/**
 * Class PatternRecognizer
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class PatternRecognizer extends AbstractRecognizer {
	/** @var array ANCHORS */
	const ANCHORS = ['start', 'end', 'anywhere'];

	/** @var array ACTIONS */
	const ACTIONS = ['down', 'up', 'silence'];

	/** @var string $anchor */
	protected $anchor = '';

	/** @var bool $fuzzy */
	protected $fuzzy = true;

	/** @var array $gadgetIds */
	protected $gadgetIds = [];

	/** @var array $actions */
	protected $actions = [];

	/** @var Pattern $pattern */
	protected $pattern;


	/**
	 * @param string  $id
	 * @param Pattern $pattern
	 */
	public function __construct(string $id, Pattern $pattern) {
		parent::__construct($id);

		$this->type = 'match';
		$this->setPattern($pattern);
	}


	/**
	 * @return string
	 */
	public function getAnchor(): string {
		return $this->anchor;
	}

	/**
	 * @param  string $anchor
	 *
	 * @return PatternRecognizer
	 * @throws InvalidArgumentException
	 */
	public function setAnchor(string $anchor): PatternRecognizer {
		if(!empty($anchor) && !in_array($anchor, self::ANCHORS)) {
			throw new InvalidArgumentException('Anchor must be one of ' . implode(', ', self::ANCHORS) . ' or an empty string.');
		}

		$this->anchor = $anchor;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function getFuzzy(): bool {
		return $this->fuzzy;
	}

	/**
	 * @param  bool $fuzzy
	 *
	 * @return PatternRecognizer
	 */
	public function setFuzzy(bool $fuzzy): PatternRecognizer {
		$this->fuzzy = boolval($fuzzy);

		return $this;
	}

	/**
	 * @return array
	 */
	public function getGadgetIds(): array {
		return $this->gadgetIds;
	}

	/**
	 * @param  array $gadgetIds
	 *
	 * @return PatternRecognizer
	 */
	public function setGadgetIds(array $gadgetIds): PatternRecognizer {
		$this->gadgetIds = [];
		foreach($gadgetIds as $gadgetId) {
			$this->addGadgetId($gadgetId);
		}

		return $this;
	}

	/**
	 * @param  string $gadgetId
	 *
	 * @return PatternRecognizer
	 */
	public function addGadgetId(string $gadgetId): PatternRecognizer {
		array_push($this->gadgetIds, $gadgetId);

		return $this;
	}

	/**
	 * @return array
	 */
	public function getActions(): array {
		return $this->actions;
	}

	/**
	 * @param  array $actions
	 *
	 * @return PatternRecognizer
	 */
	public function setActions(array $actions): PatternRecognizer {
		$this->actions = [];
		foreach($actions as $action) {
			$this->addAction($action);
		}

		return $this;
	}

	/**
	 * @param  string $action
	 *
	 * @return PatternRecognizer
	 * @throws InvalidArgumentException
	 */
	public function addAction(string $action): PatternRecognizer {
		if(!in_array($action, self::ACTIONS)) {
			throw new InvalidArgumentException('Action must be one of ' . implode(', ', self::ACTIONS) . '.');
		}

		array_push($this->actions, $action);

		return $this;
	}

	/**
	 * @return Pattern
	 */
	public function getPattern(): Pattern {
		return $this->pattern;
	}

	/**
	 * @param  Pattern $pattern
	 *
	 * @return PatternRecognizer
	 */
	public function setPattern(Pattern $pattern): PatternRecognizer {
		$this->pattern = $pattern;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		$rendered = [
			'type'    => $this->getType(),
			'fuzzy'   => $this->getFuzzy(),
			'pattern' => $this->getPattern()->render(),
		];

		if($anchor = $this->getAnchor()) {
			$rendered['anchor'] = $anchor;
		}

		if($gadgetIds = $this->getGadgetIds()) {
			$rendered['gadgetIds'] = $gadgetIds;
		}

		if($actions = $this->getActions()) {
			$rendered['actions'] = $actions;
		}

		return $rendered;
	}
}
