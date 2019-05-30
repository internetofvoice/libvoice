<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\GameEngine;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AbstractDirective;
use \InvalidArgumentException;

/**
 * Class StartInputHandler
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class StartInputHandler extends AbstractDirective {
	const MIN_TIMEOUT = 0;
	const MAX_TIMEOUT = 90000;

	const MAX_RECOGNIZERS = 20;

	const MIN_EVENTS = 1;
	const MAX_EVENTS = 32;

	/** @var int $timeout */
	protected $timeout = 5000;

	/** @var array $proxies */
	protected $proxies = [];

	/** @var AbstractRecognizer[] $recognizers */
	protected $recognizers = [];

	/** @var Event[] $events */
	protected $events = [];


	/**
	 * @param Event[]              $events
	 * @param AbstractRecognizer[] $recognizers
	 * @param array                $proxies
	 * @param int                  $timeout
	 */
	public function __construct($events, $recognizers = [], $proxies = [], $timeout = 5000) {
		parent::__construct();

		$this->type = 'GameEngine.StartInputHandler';
		$this->setEvents($events);
		$this->setRecognizers($recognizers);
		$this->setProxies($proxies);
		$this->setTimeout($timeout);
	}


	/**
	 * @return int
	 */
	public function getTimeout() {
		return $this->timeout;
	}

	/**
	 * @param  int $timeout
	 *
	 * @return StartInputHandler
	 * @throws InvalidArgumentException
	 */
	public function setTimeout($timeout) {
		if(!is_int($timeout) || $timeout < self::MIN_TIMEOUT || $timeout > self::MAX_TIMEOUT) {
			throw new InvalidArgumentException('Timeout must be a number between ' . self::MIN_TIMEOUT . ' and ' . self::MAX_TIMEOUT . '.');
		}

		$this->timeout = $timeout;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getProxies() {
		return $this->proxies;
	}

	/**
	 * @param  array $proxies
	 *
	 * @return StartInputHandler
	 */
	public function setProxies($proxies) {
		$this->proxies = [];
		foreach($proxies as $proxy) {
			$this->addProxy($proxy);
		}

		return $this;
	}

	/**
	 * @param  string $proxy
	 *
	 * @return StartInputHandler
	 */
	public function addProxy($proxy) {
		array_push($this->proxies, $proxy);

		return $this;
	}

	/**
	 * @return AbstractRecognizer[]
	 */
	public function getRecognizers() {
		return $this->recognizers;
	}

	/**
	 * @param  AbstractRecognizer[] $recognizers
	 *
	 * @return StartInputHandler
	 */
	public function setRecognizers($recognizers) {
		$this->recognizers = [];
		foreach($recognizers as $recognizer) {
			$this->addRecognizer($recognizer);
		}

		return $this;
	}

	/**
	 * @param  AbstractRecognizer $recognizer
	 *
	 * @return StartInputHandler
	 * @throws InvalidArgumentException
	 */
	public function addRecognizer($recognizer) {
		if(count($this->recognizers) >= self::MAX_RECOGNIZERS) {
			throw new InvalidArgumentException('Maximum number of recognizers: ' . self::MAX_RECOGNIZERS . '.');
		}

		array_push($this->recognizers, $recognizer);

		return $this;
	}

	/**
	 * @return Event[]
	 */
	public function getEvents() {
		return $this->events;
	}

	/**
	 * @param  Event[] $events
	 *
	 * @return StartInputHandler
	 */
	public function setEvents($events) {
		$this->events = [];
		foreach($events as $event) {
			$this->addEvent($event);
		}

		return $this;
	}

	/**
	 * @param  Event $event
	 *
	 * @return StartInputHandler
	 * @throws InvalidArgumentException
	 */
	public function addEvent($event) {
		if(count($this->events) >= self::MAX_EVENTS) {
			throw new InvalidArgumentException('Maximum number of events: ' . self::MAX_EVENTS . '.');
		}

		array_push($this->events, $event);

		return $this;
	}


	/**
	 * @return array
	 * @throws InvalidArgumentException
	 */
	public function render() {
		if(count($this->events) < self::MIN_EVENTS) {
			throw new InvalidArgumentException('You have to set at least ' . self::MIN_EVENTS . ' events.');
		}

		$rendered = [
			'type'        => $this->getType(),
			'timeout'     => $this->getTimeout(),
			'recognizers' => [],
			'events'      => [],
		];

		foreach($this->getRecognizers() as $recognizer) {
			$rendered['recognizers'][$recognizer->getId()] = $recognizer->render();
		}

		foreach($this->getEvents() as $event) {
			$rendered['events'][$event->getId()] = $event->render();
		}

		if($proxies = $this->getProxies()) {
			$rendered['proxies'] = $proxies;
		}

		return $rendered;
	}
}
