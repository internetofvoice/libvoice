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
	 * @param array $data
	 */
	public function __construct($data) {
		$this->response = new Response($data['response']);
		$this->context = new Context($data['context']);
	}


    /**
     * @return Response
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * @return Context
     */
    public function getContext() {
        return $this->context;
    }
}
