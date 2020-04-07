<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\GameEngine;

/**
 * Class Event
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Event {
	/** @var string $name */
	protected $name;

	/** @var InputEvent[] $inputEvents */
	protected $inputEvents = [];


	/**
	 * @param array $requestData
	 */
	public function __construct(array $requestData) {
		if(isset($requestData['name'])) {
			$this->name = $requestData['name'];
		}

		if(isset($requestData['inputEvents']) && is_array($requestData['inputEvents'])) {
			foreach($requestData['inputEvents'] as $data) {
				array_push($this->inputEvents, new InputEvent($data));
			}
		}
	}


	/**
	 * @return string
	 */
	public function getName(): string  {
		return $this->name;
	}

	/**
	 * @return InputEvent[]
	 */
	public function getInputEvents(): array {
		return $this->inputEvents;
	}
}
