<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Response;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event;

/**
 * Class Response
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Response {
	/** @var Event $event */
	protected $event;

	/** @var Context $context */
	protected $context;

	/**
	 * @param Event $event
	 */
	public function __construct($event = null, $context = null) {
		$this->setEvent($event);
		$this->setContext($context);
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
	 * @return Context
	 */
	public function getContext() {
		return $this->context;
	}

	/**
	 * @param Context $context
	 *
	 * @return Response
	 */
	public function setContext($context) {
		$this->context = $context;

		return $this;
	}


    /**
     * @return  array
     */
    function render() {
        $rendered = [
            'event' => $this->getEvent()->render(),
        ];

	    if(!is_null($this->getContext())) {
		    $rendered['context'] = $this->getContext()->render();
	    }

        return $rendered;
    }
}
