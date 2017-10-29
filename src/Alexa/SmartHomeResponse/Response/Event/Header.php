<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event;

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

		// @TODO: auto-create with $this->createMessageId()?
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

    /**
     * Creates a version 4 UUID
     *
     * @author  Andrew Moore
     * @see     http://php.net/manual/de/function.uniqid.php#94959
     */
    public function createMessageId() {
        $this->messageId = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
	}
}
