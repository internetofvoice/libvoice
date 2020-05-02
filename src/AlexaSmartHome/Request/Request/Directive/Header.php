<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Request\Request\Directive;

use \InvalidArgumentException;

/**
 * Class Header
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Header {
	/** @var string $namespace */
	protected $namespace = '';

	/** @var string $name */
	protected $name = '';

	/** @var string $payloadVersion */
	protected $payloadVersion = '';

	/** @var string $messageId */
	protected $messageId = '';

	/** @var string $correlationToken */
	protected $correlationToken = '';


	/**
	 * @param  array $headerData
	 *
	 * @throws InvalidArgumentException
	 */
	public function __construct(array $headerData) {
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

		$this->namespace      = $headerData['namespace'];
		$this->name           = $headerData['name'];
		$this->payloadVersion = $headerData['payloadVersion'];
		$this->messageId      = $headerData['messageId'];

		if(isset($headerData['correlationToken'])) {
			$this->correlationToken = $headerData['correlationToken'];
		}
	}


	/**
	 * @return string
	 */
	public function getNamespace(): string {
		return $this->namespace;
	}

	/**
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getPayloadVersion(): string {
		return $this->payloadVersion;
	}

	/**
	 * @return string
	 */
	public function getMessageId(): string {
		return $this->messageId;
	}

	/**
	 * @return string
	 */
	public function getCorrelationToken(): string {
		return $this->correlationToken;
	}
}
