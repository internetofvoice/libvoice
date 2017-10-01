<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request;

use DateTime;

abstract class AbstractRequest {
	/** @var string $type */
	protected $type;

	/** @var string $requestId */
	protected $requestId;

	/** @var DateTime $timestamp */
	protected $timestamp;

	/** @var string $locale */
	protected $locale;


	/**
	 * @param   array $requestData
	 */
	public function __construct($requestData) {
		$this->type = $requestData['type'];
		$this->locale = $requestData['locale'];
		$this->requestId = $requestData['requestId'];

		$timestamp = is_numeric($requestData['timestamp']) ? '@' . substr($requestData['timestamp'], 0, 10) : $requestData['timestamp'];
		$this->timestamp = new DateTime($timestamp);
	}


	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getRequestId() {
		return $this->requestId;
	}

	/**
	 * @return DateTime
	 */
	public function getTimestamp() {
		return $this->timestamp;
	}

	/**
	 * @return string
	 */
	public function getLocale() {
		return $this->locale;
	}
}
