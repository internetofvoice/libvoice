<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\Display;

use \InternetOfVoice\LibVoice\Alexa\Request\Request\AbstractRequest;

/**
 * Class ElementSelected
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ElementSelected extends AbstractRequest {
	/** @var string $token */
	protected $token;


	/**
	 * @param array $requestData
	 */
	public function __construct(array $requestData) {
		parent::__construct($requestData);

		if(isset($requestData['token'])) {
			$this->token = $requestData['token'];
		}
	}


	/**
	 * @return string
	 */
	public function getToken(): string  {
		return $this->token;
	}
}
