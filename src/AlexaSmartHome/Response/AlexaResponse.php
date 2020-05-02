<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Response;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Endpoint;
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


	/**
	 * @param Response $response
	 */
	public function __construct(Response $response = null) {
		if(!is_null($response)) {
			$this->setResponse($response);
		}
	}

	/**
	 * Create AlexaResponse skeleton
	 *
     * Supported templates: Discovery, StateReport, Response
     *
     * @param  string $template
	 *
	 * @return AlexaResponse
     * @throws InvalidArgumentException
	 */
	public static function create(string $template = 'Response'): AlexaResponse {
	    $return = null;

	    switch ($template) {
		    case 'Authorization':
		    case 'Discovery':
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

            case 'StateReport':
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

            default:
                throw new InvalidArgumentException('Unsupported AlexaResponse template: ' . $template);
            break;
        }

        return $return;
	}


	/**
     * @return null|Response
     */
    public function getResponse(): ?Response {
        return $this->response;
    }

    /**
     * @param  Response $response
     *
     * @return AlexaResponse
     */
    public function setResponse(Response $response): AlexaResponse {
        $this->response = $response;

        return $this;
    }

	/**
	 * Shortcut to Event Header
	 *
	 * @return null|Header
	 */
    public function getHeader(): ?Header {
		return $this->getResponse()->getEvent()->getHeader();
    }

	/**
	 * Shortcut to Event Payload
	 *
	 * @return null|Payload
	 */
	public function getPayload(): ?Payload {
		return $this->getResponse()->getEvent()->getPayload();
	}

    /**
     * Shortcut to Event Endpoint
     *
     * @return null|Endpoint
     */
    public function getEndpoint(): ?Endpoint {
        return $this->getResponse()->getEvent()->getEndpoint();
    }


    /**
     * @return array
     * @throws InvalidArgumentException
     */
    function render(): array {
	    if(is_null($this->getResponse())) {
		    throw new InvalidArgumentException('Missing response.');
	    }

        return [
            'response' => $this->getResponse()->render(),
        ];
    }
}
