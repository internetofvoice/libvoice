<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Response;

use InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Endpoint;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event\Header;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event\Payload;
use \InvalidArgumentException;

/**
 * Class AlexaResponse
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class AlexaResponse {
	/** @var Response $response */
	protected $response;

	/** @var Context $context */
	protected $context;


	/**
	 * @param Response $response
	 * @param Context $context
	 */
	public function __construct($response = null, $context = null) {
		$this->setResponse($response);
		$this->setContext($context);
	}

	/**
	 * Create AlexaResponse skeleton
	 *
     * Supported templates: Discovery, StateReport, Response
     *
     * @param  string $template
	 * @return AlexaResponse
     * @throws InvalidArgumentException
	 */
	public static function create($template = 'Response') {
	    $return = null;

	    switch ($template) {
            case 'Discovery':
                $return = new AlexaResponse(
                    new Response(
                        new Event(
                            new Header(),
                            new Payload()
                        )
                    )
                );
            break;

            case 'StateReport':
                $return = new AlexaResponse(
                    new Response(
                        new Event(
                            new Header(),
                            new Payload(),
                            new Endpoint()
                        ),
	                    new Context()
                    )
                );
            break;

            case 'Response':
                $return = new AlexaResponse(
                    new Response(
                        new Event(
                            new Header(),
                            new Payload(),
                            new Endpoint()
                        ),
	                    new Context()
                    )
                );
            break;

		    case 'Authorization':
			    $return = new AlexaResponse(
				    new Response(
					    new Event(
						    new Header(),
						    new Payload()
					    )
				    )
			    );
		    break;

		    case 'Error':
			    $return = new AlexaResponse(
				    new Response(
					    new Event(
						    new Header(),
						    new Payload()
					    )
				    )
			    );
		    break;

            default:
                throw new InvalidArgumentException('Unsupported AlexaResponse template: ' . $template);
            break;
        }

        return $return;
	}


	/**
     * @return Response
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * @param Response $response
     * @return AlexaResponse
     */
    public function setResponse($response) {
        $this->response = $response;
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
     * @return AlexaResponse
     */
    public function setContext($context) {
        $this->context = $context;
        return $this;
    }


	/**
	 * Shortcut to Event Header
	 *
	 * @return Header
	 */
    public function getHeader() {
		return $this->getResponse()->getEvent()->getHeader();
    }

	/**
	 * Shortcut to Event Payload
	 *
	 * @return Payload
	 */
	public function getPayload() {
		return $this->getResponse()->getEvent()->getPayload();
	}

    /**
     * Shortcut to Event Endpoint
     *
     * @return Endpoint
     */
    public function getEndpoint() {
        return $this->getResponse()->getEvent()->getEndpoint();
    }


    /**
     * @return  array
     */
    function render() {
        $rendered = [
            'response' => $this->getResponse()->render(),
        ];

        if(!is_null($this->getContext())) {
        	$rendered['context'] = $this->getContext()->render();
        }

        return $rendered;
    }
}
