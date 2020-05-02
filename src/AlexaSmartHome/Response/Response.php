<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Response;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event;
use InvalidArgumentException;

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
	 * @param Event   $event
	 * @param Context $context
	 */
	public function __construct(Event $event = null, Context $context = null) {
		if(!is_null($event)) {
			$this->setEvent($event);
		}

		if(!is_null($context)) {
			$this->setContext($context);
		}
	}


    /**
     * @return  null|Event
     */
    public function getEvent(): ?Event {
        return $this->event;
    }

    /**
     * @param   Event $event
     *
     * @return  Response
     */
    public function setEvent(Event $event): Response {
        $this->event = $event;

        return $this;
    }

	/**
	 * @return null|Context
	 */
	public function getContext(): ?Context {
		return $this->context;
	}

	/**
	 * @param  Context $context
	 *
	 * @return Response
	 */
	public function setContext(Context $context): Response {
		$this->context = $context;

		return $this;
	}


    /**
     * @return array
     * @throws InvalidArgumentException
     */
    function render(): array {
	    if(is_null($this->getEvent())) {
		    throw new InvalidArgumentException('Missing event.');
	    }

        $rendered = [
            'event' => $this->getEvent()->render(),
        ];

	    if(!is_null($this->getContext())) {
		    $rendered['context'] = $this->getContext()->render();
	    }

        return $rendered;
    }
}
