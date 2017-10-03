<?php

namespace InternetOfVoice\LibVoice\Alexa\Response;

use Alexa\Alexa\Response\Card\LinkAccount;
use Alexa\Alexa\Response\Card\Simple as SimpleCard;
use Alexa\Alexa\Response\Card\Standard as StandardCard;
use InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\PlainText;
use InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\SSML;

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

	/** @var  Response $response */
	protected $response;


	public function __construct() {
		$this->response = new Response();
	}


	/**
	 * Shortcut to Response->setOutputSpeech(PlainText)
	 *
	 * @param string $text
	 *
	 * @return AlexaResponse
	 */
	public function respond($text) {
		$this->getResponse()->setOutputSpeech(new PlainText($text));

		return $this;
	}

	/**
	 * Shortcut to Response->setOutputSpeech(SSML)
	 *
	 * @param string $ssml
	 *
	 * @return AlexaResponse
	 */
	public function respondSSML($ssml) {
		$this->getResponse()->setOutputSpeech(new SSML($ssml));

		return $this;
	}

	/**
	 * Shortcut to Response->setCard(SimpleCard)
	 *
	 * @param string $title
	 * @param string $content
	 *
	 * @return AlexaResponse
	 */
	public function withSimpleCard($title, $content) {
		$this->getResponse()->setCard(new SimpleCard($title, $content));

		return $this;
	}

	/**
	 * Shortcut to Response->setCard(StandardCard)
	 *
	 * @param string $title
	 * @param string $text
	 * @param string $smallImageUrl
	 * @param string $largeImageUrl
	 *
	 * @return AlexaResponse
	 */
	public function withStandardCard($title, $text, $smallImageUrl, $largeImageUrl) {
		$this->getResponse()->setCard(new StandardCard($title, $text, $smallImageUrl, $largeImageUrl));

		return $this;
	}

	/**
	 * Shortcut to Response->setCard(LinkAccount)
	 *
	 * @return AlexaResponse
	 */
	public function withLinkAccount() {
		$this->getResponse()->setCard(new LinkAccount());

		return $this;
	}

	/**
	 * Shortcut to Response->setReprompt(PlainText)
	 *
	 * @param string $text
	 *
	 * @return AlexaResponse
	 */
	public function reprompt($text) {
		$this->getResponse()->setReprompt(new Reprompt('PlainText', $text));

		return $this;
	}

	/**
	 * Shortcut to Response->setReprompt(SSML)
	 *
	 * @param string $ssml
	 *
	 * @return AlexaResponse
	 */
	public function repromptSSML($ssml) {
		$this->getResponse()->setReprompt(new Reprompt('SSML', $ssml));

		return $this;
	}

	/**
	 * Shortcut to Response->setShouldEndSession
	 *
	 * @param bool $shouldEndSession
	 *
	 * @return AlexaResponse
	 */
	public function endSession($shouldEndSession) {
		$this->getResponse()->setShouldEndSession($shouldEndSession);

		return $this;
	}


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
	 * @return Response
	 */
	public function getResponse() {
		return $this->response;
	}

	/**
	 * @return array
	 */
	public function render() {
		$rendered = array();

		$rendered['version']           = $this->version;
		$rendered['sessionAttributes'] = $this->sessionAttributes;
		$rendered['response']          = $this->response->render();

		return $rendered;
	}
}
