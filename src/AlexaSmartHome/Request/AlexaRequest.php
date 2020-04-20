<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Request;

use \DateTime;
use \Exception;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Endpoint;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Request\Request\Directive\Header;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Request\Request\Directive\Payload;
use \InvalidArgumentException;

/**
 * Class AlexaRequest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class AlexaRequest {
	/** @var Request $request */
	protected $request;

	/** @var Context $context */
	protected $context;

    /** @var DateTime $timestamp */
	protected $timestamp;


	/**
	 * @param  string $rawData
	 * @param  string $signature
	 * @param  string $secret
	 * @param  bool   $validateSignature
	 * @param  bool   $validateTimestamp
	 *
	 * @throws InvalidArgumentException
	 */
	public function __construct(string $rawData, string $signature = '', string $secret = '', bool $validateSignature = true, bool $validateTimestamp = true) {
		$data = json_decode($rawData, true);

		// Request validation
		if($validateSignature) {
			RequestValidator::validateSignature($rawData, $signature, $secret);
			if($validateTimestamp) {
				RequestValidator::validateTimestamp($data['timestamp']);
			}
		}

		if(!isset($data['request'])) {
			throw new InvalidArgumentException('Missing request data.');
		}

		if(!isset($data['context'])) {
			throw new InvalidArgumentException('Missing context data.');
		}

		$this->request = new Request($data['request']);
		$this->context = new Context($data['context']);

        if(isset($data['timestamp'])) {
            try {
                $this->timestamp = new DateTime($data['timestamp']);
            } catch(Exception $e) {
                $this->timestamp = null;
            }
     	}
	}


	/**
	 * @return Request
	 */
	public function getRequest(): Request {
		return $this->request;
	}

	/**
	 * @return Context
	 */
	public function getContext(): Context {
		return $this->context;
	}

    /**
     * @return null|DateTime
     */
    public function getTimestamp(): ?DateTime {
        return $this->timestamp;
    }

    /**
     * @param  string  $format  see http://php.net/manual/de/function.date.php#refsect1-function.date-parameters
     *
     * @return string
     */
    public function getTimestampAsString(string $format = 'c'): string {
    	$timestamp = $this->getTimestamp();

    	return is_null($timestamp) ? '' : $timestamp->format($format);
    }


    /**
     * Shortcut to Directive Header
     *
     * @return Header
     */
    public function getHeader(): Header {
        return $this->getRequest()->getDirective()->getHeader();
    }

    /**
     * Shortcut to Directive Payload
     *
     * @return Payload
     */
    public function getPayload(): Payload {
        return $this->getRequest()->getDirective()->getPayload();
    }

	/**
	 * Shortcut to Directive Endpoint
	 *
	 * @return Endpoint
	 */
	public function getEndpoint(): Endpoint {
		return $this->getRequest()->getDirective()->getEndpoint();
	}
}
