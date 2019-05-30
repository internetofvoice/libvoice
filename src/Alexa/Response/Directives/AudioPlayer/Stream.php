<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\AudioPlayer;

/**
 * Class Stream
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Stream {
	/** @var string $url */
	protected $url;

	/** @var string $token */
	protected $token;

	/** @var string $expectedPreviousToken */
	protected $expectedPreviousToken;

	/** @var int $offsetInMilliseconds */
	protected $offsetInMilliseconds;


	/**
	 * @param string $url
	 * @param string $token
	 * @param string $expectedPreviousToken
	 * @param int    $offsetInMilliseconds
	 */
	public function __construct($url, $token, $expectedPreviousToken = '', $offsetInMilliseconds = 0) {
		$this->setUrl($url);
		$this->setToken($token);
		$this->setExpectedPreviousToken($expectedPreviousToken);
		$this->setOffsetInMilliseconds($offsetInMilliseconds);
	}


	/**
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * @param string $url
	 *
	 * @return Stream
	 */
	public function setUrl($url) {
		$this->url = $url;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getToken() {
		return $this->token;
	}

	/**
	 * @param string $token
	 *
	 * @return Stream
	 */
	public function setToken($token) {
		$this->token = $token;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getExpectedPreviousToken() {
		return $this->expectedPreviousToken;
	}

	/**
	 * @param string $expectedPreviousToken
	 *
	 * @return Stream
	 */
	public function setExpectedPreviousToken($expectedPreviousToken) {
		$this->expectedPreviousToken = $expectedPreviousToken;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getOffsetInMilliseconds() {
		return $this->offsetInMilliseconds;
	}

	/**
	 * @param int $offsetInMilliseconds
	 *
	 * @return Stream
	 */
	public function setOffsetInMilliseconds($offsetInMilliseconds) {
		$this->offsetInMilliseconds = intval($offsetInMilliseconds);

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		return [
			'url'                   => $this->getUrl(),
			'token'                 => $this->getToken(),
			'expectedPreviousToken' => $this->getExpectedPreviousToken(),
			'offsetInMilliseconds'  => $this->getOffsetInMilliseconds(),
		];
	}
}
