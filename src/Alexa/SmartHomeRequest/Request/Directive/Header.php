<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeRequest\Request\Directive;

use \InvalidArgumentException;

/**
 * Class Header
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Header {
	/** @var string $namespace */
	protected $namespace;

	/** @var string $name */
	protected $name;

	/** @var string $payloadVersion */
	protected $payloadVersion;

	/** @var string $messageId */
	protected $messageId;


	/**
	 * @param array $headerData
	 * @throws InvalidArgumentException
	 */
	public function __construct($headerData) {
		if(!isset($headerData['namespace'])) {
			throw new InvalidArgumentException('Missing namespace.');
		}

		if(!isset($headerData['name'])) {
			throw new InvalidArgumentException('Missing name.');
		}

		if(!isset($headerData['payloadVersion'])) {
			throw new InvalidArgumentException('Missing payloadVersion.');
		}

		if(!isset($headerData['messageId'])) {
			throw new InvalidArgumentException('Missing messageId.');
		}

		$this->namespace = $headerData['namespace'];
		$this->name = $headerData['name'];
		$this->payloadVersion = $headerData['payloadVersion'];
		$this->messageId = $headerData['messageId'];
	}


	/**
	 * @return string
	 */
	public function getNamespace() {
		return $this->namespace;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getPayloadVersion() {
		return $this->payloadVersion;
	}

	/**
	 * @return string
	 */
	public function getMessageId() {
		return $this->messageId;
	}
}
