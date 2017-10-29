<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response;

/**
 * Class Event
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Event {
	/** @var $header */
	protected $header;

	/** @var $payload */
	protected $payload;


	/**
	 * @param array $eventData
	 */
	public function __construct($eventData) {
//		$this->header = new Header($eventData['header']);
//		$this->payload = new Payload($eventData['payload']);
	}
}
