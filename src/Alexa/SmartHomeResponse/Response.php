<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeResponse;

use \InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event;

/**
 * Class Response
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Response {
	/** @var Event $event */
	protected $event;


	/**
	 * @param Event $event
	 */
	public function __construct($event = null) {
		$this->setEvent($event);
	}


    /**
     * @return  Event
     */
    public function getEvent() {
        return $this->event;
    }

    /**
     * @param   Event $event
     * @return  Response
     */
    public function setEvent($event) {
        $this->event = $event;
        return $this;
    }


    /**
     * @return  array
     */
    function render() {
        $rendered = [
            'event' => $this->getEvent()->render(),
        ];

        return $rendered;
    }
}
