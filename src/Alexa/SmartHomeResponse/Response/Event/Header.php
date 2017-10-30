<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event;

use \InternetOfVoice\LibVoice\Alexa\SmartHomeRequest\Request\Directive\Header as RequestHeader;

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
	public function __construct($headerData = []) {
		if(isset($headerData['namespace'])) {
			$this->setNamespace($headerData['namespace']);
		}

		if(isset($headerData['name'])) {
			$this->setName($headerData['name']);
		}

		if(isset($headerData['payloadVersion'])) {
			$this->setPayloadVersion($headerData['payloadVersion']);
		}

		if(isset($headerData['messageId'])) {
			$this->setMessageId($headerData['messageId']);
		}
	}


	/**
     * @param RequestHeader $requestHeader
     * @param bool $overrideMessageId
     */
    public function createFromRequestHeader($requestHeader, $overrideMessageId = true) {
        $this->setNamespace($requestHeader->getNamespace());
        $this->setName($requestHeader->getName());
        $this->setPayloadVersion($requestHeader->getPayloadVersion());
        $this->setMessageId($overrideMessageId ? $this->createMessageId() : $requestHeader->getMessageId());
	}


    /**
     * @return string
     */
    public function getNamespace() {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     * @return Header
     */
    public function setNamespace($namespace) {
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Header
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPayloadVersion() {
        return $this->payloadVersion;
    }

    /**
     * @param string $payloadVersion
     * @return Header
     */
    public function setPayloadVersion($payloadVersion) {
        $this->payloadVersion = $payloadVersion;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessageId() {
        return $this->messageId;
    }

    /**
     * @param string $messageId
     * @return Header
     */
    public function setMessageId($messageId) {
        $this->messageId = $messageId;
        return $this;
    }

    /**
     * Create a random version 4 UUID
     *
     * @return  string
     * @author  Andrew Moore
     * @see     http://php.net/manual/de/function.uniqid.php#94959
     */
    public function createMessageId() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits (8 bits for "clk_seq_hi_res" and 8 bits for "clk_seq_low"),
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
	}


    /**
     * @return  array
     */
    function render() {
        $rendered = [
	        'namespace'      => $this->getNamespace(),
	        'name'           => $this->getName(),
	        'payloadVersion' => $this->getPayloadVersion(),
	        'messageId'      => $this->getMessageId(),
        ];

        return $rendered;
    }
}
