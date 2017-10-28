<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeRequest\Request\Directive;

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
	 */
	public function __construct($headerData) {
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
