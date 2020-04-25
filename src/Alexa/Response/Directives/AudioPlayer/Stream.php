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
	 * @param int    $offsetInMilliseconds
	 * @param string $expectedPreviousToken
	 */
	public function __construct(string $url, string $token, int $offsetInMilliseconds = 0, string $expectedPreviousToken = '') {
		$this->setUrl($url);
		$this->setToken($token);
		$this->setOffsetInMilliseconds($offsetInMilliseconds);
		$this->setExpectedPreviousToken($expectedPreviousToken);
	}


	/**
	 * @return string
	 */
	public function getUrl(): string {
		return $this->url;
	}

	/**
	 * @param string $url
	 *
	 * @return Stream
	 */
	public function setUrl(string $url): Stream {
		$this->url = $url;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getToken(): string {
		return $this->token;
	}

	/**
	 * @param string $token
	 *
	 * @return Stream
	 */
	public function setToken(string $token): Stream {
		$this->token = $token;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getExpectedPreviousToken(): string {
		return $this->expectedPreviousToken;
	}

	/**
	 * @param string $expectedPreviousToken
	 *
	 * @return Stream
	 */
	public function setExpectedPreviousToken(string $expectedPreviousToken): Stream {
		$this->expectedPreviousToken = $expectedPreviousToken;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getOffsetInMilliseconds(): int {
		return $this->offsetInMilliseconds;
	}

	/**
	 * @param int $offsetInMilliseconds
	 *
	 * @return Stream
	 */
	public function setOffsetInMilliseconds(int $offsetInMilliseconds): Stream {
		$this->offsetInMilliseconds = intval($offsetInMilliseconds);

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'url'                   => $this->getUrl(),
			'token'                 => $this->getToken(),
			'expectedPreviousToken' => $this->getExpectedPreviousToken(),
			'offsetInMilliseconds'  => $this->getOffsetInMilliseconds(),
		];
	}
}
