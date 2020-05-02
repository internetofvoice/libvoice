<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request;

use \DateTime;
use \Exception;

/**
 * Abstract Class AbstractRequest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
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
	 * @param array $requestData
	 */
	public function __construct(array $requestData) {
		$this->type      = $requestData['type'];
		$this->locale    = $requestData['locale'];
		$this->requestId = $requestData['requestId'];

		$timestamp = is_numeric($requestData['timestamp']) ? '@' . substr($requestData['timestamp'], 0, 10) : $requestData['timestamp'];

		try {
			$this->timestamp = new DateTime($timestamp);
		} catch(Exception $e) {
			$this->timestamp = null;
		}
	}


	/**
	 * @return string
	 */
	public function getType(): string {
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getRequestId(): string  {
		return $this->requestId;
	}

	/**
	 * @return null|DateTime
	 */
	public function getTimestamp(): ?DateTime {
		return $this->timestamp;
	}

	/**
	 * @return string
	 */
	public function getLocale(): string  {
		return $this->locale;
	}
}
