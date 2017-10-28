<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeRequest;

/**
 * Class AlexaRequest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class AlexaRequest {
	/** @var Request $request */
	protected $request;

	/** @var Context $context */
	protected $context;


	/**
	 * @param array $data
	 */
	public function __construct($data) {
		$this->request = new Request($data['request']);
		$this->context = new Context($data['context']);
	}


	/**
	 * @return Request
	 */
	public function getRequest() {
		return $this->request;
	}

	/**
	 * @return Context
	 */
	public function getContext() {
		return $this->context;
	}


	/**
	 * @return string
	 */
	public function getRequestInterface() {
		return $this->request->getDirective()->getHeader()->getNamespace();
	}
}
