<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Request\Request\Directive\Header as RequestHeader;

/**
 * Class Header
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Header {
	/** @var string $namespace */
	protected $namespace = 'Alexa';

	/** @var string $name */
	protected $name = '';

	/** @var string $payloadVersion */
	protected $payloadVersion = '3';

	/** @var string $messageId */
	protected $messageId = '';

    /** @var string $correlationToken */
	protected $correlationToken = '';


	/**
	 * @param array $headerData
	 */
	public function __construct(array $headerData = []) {
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

        if(isset($headerData['correlationToken'])) {
            $this->setCorrelationToken($headerData['correlationToken']);
        }
	}


	/**
	 * @param RequestHeader $requestHeader
	 * @param bool          $overrideMessageId
     */
    public function createFromRequestHeader(RequestHeader $requestHeader, bool $overrideMessageId = true) {
        $this->setNamespace($requestHeader->getNamespace());
        $this->setName($requestHeader->getName());
        $this->setPayloadVersion($requestHeader->getPayloadVersion());
        $this->setMessageId($overrideMessageId ? $this->createMessageId() : $requestHeader->getMessageId());
        $this->setCorrelationToken($requestHeader->getCorrelationToken());
	}


    /**
     * @return string
     */
    public function getNamespace(): string {
        return $this->namespace;
    }

    /**
     * @param  string $namespace
     *
     * @return Header
     */
    public function setNamespace(string $namespace): Header {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param  string $name
     *
     * @return Header
     */
    public function setName(string $name): Header {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getPayloadVersion(): string {
        return $this->payloadVersion;
    }

    /**
     * @param  string $payloadVersion
     *
     * @return Header
     */
    public function setPayloadVersion(string $payloadVersion): Header {
        $this->payloadVersion = $payloadVersion;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessageId(): string {
        return $this->messageId;
    }

    /**
     * @param  string $messageId
     *
     * @return Header
     */
    public function setMessageId(string $messageId): Header {
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
    public function createMessageId(): string {
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
     * @return string
     */
    public function getCorrelationToken(): string {
        return $this->correlationToken;
    }

    /**
     * @param  string $correlationToken
     *
     * @return Header
     */
    public function setCorrelationToken(string $correlationToken): Header {
        $this->correlationToken = $correlationToken;

        return $this;
    }


    /**
     * @return  array
     */
    function render(): array {
        $rendered = [
	        'namespace'      => $this->getNamespace(),
	        'name'           => $this->getName(),
	        'payloadVersion' => $this->getPayloadVersion(),
	        'messageId'      => $this->getMessageId(),
        ];

        if($this->getCorrelationToken()) {
            $rendered['correlationToken'] = $this->getCorrelationToken();
        }

        return $rendered;
    }
}
