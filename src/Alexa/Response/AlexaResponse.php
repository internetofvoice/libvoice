<?php

namespace InternetOfVoice\LibVoice\Alexa\Response;

/**
 * Class AlexaResponse
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class AlexaResponse {
	/** @var  string $version */
	protected $version = '1.0';

	/** @var  array $sessionAttributes */
	protected $sessionAttributes = [];

	//	protected $response;


	/**
	 * @return string
	 */
	public function getVersion() {
		return $this->version;
	}

	/**
	 * @param string $version
	 *
	 * @return AlexaResponse
	 */
	public function setVersion($version) {
		$this->version = $version;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getSessionAttributes() {
		return $this->sessionAttributes;
	}

	/**
	 * @param array $sessionAttributes
	 *
	 * @return AlexaResponse
	 */
	public function setSessionAttributes($sessionAttributes) {
		$this->sessionAttributes = $sessionAttributes;

		return $this;
	}

	/**
	 * @var string $key
	 * @var mixed  $default
	 *
	 * @return mixed
	 */
	public function getSessionAttribute($key, $default = false) {
		return isset($this->sessionAttributes[$key]) ? $this->sessionAttributes[$key] : $default;
	}

	/**
	 * @var string $key
	 * @var mixed  $value
	 *
	 * @return AlexaResponse
	 */
	public function setSessionAttribute($key, $value) {
		$this->sessionAttributes[$key] = $value;

		return $this;
	}

	/**
	 * @return array
	 */
	public function render() {
		$rendered = [];

		// @TODO
		return $rendered;
	}
}
