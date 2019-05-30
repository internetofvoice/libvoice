<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\GameEngine;

use \InternetOfVoice\LibVoice\Alexa\Request\Request\AbstractRequest;

/**
 * Class InputHandlerEvent
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class InputHandlerEvent extends AbstractRequest {
	/** @var string $originatingRequestId */
	protected $originatingRequestId;

	/** @var Event[] $events */
	protected $events = [];


	/**
	 * @param array $requestData
	 */
	public function __construct($requestData) {
		parent::__construct($requestData);

		if(isset($requestData['originatingRequestId'])) {
			$this->originatingRequestId = $requestData['originatingRequestId'];
		}

		if(isset($requestData['events']) && is_array($requestData['events'])) {
			foreach($requestData['events'] as $data) {
				array_push($this->events, new Event($data));
			}
		}
	}


	/**
	 * @return string
	 */
	public function getOriginatingRequestId() {
		return $this->originatingRequestId;
	}

	/**
	 * @return Event[]
	 */
	public function getEvents() {
		return $this->events;
	}
}
