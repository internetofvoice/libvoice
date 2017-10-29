<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeResponse;


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
     * @return  array
     */
    function render() {
        $rendered = [
            'response' => $this->getResponse()->render(),
            'context' => $this->getContext()->render(),
        ];

        return $rendered;
    }
}
