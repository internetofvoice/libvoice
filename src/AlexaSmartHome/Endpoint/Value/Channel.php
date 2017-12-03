<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value;

use \InvalidArgumentException;

/**
 * Class Channel
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Channel {
    /** @var string $number */
    protected $number;

    /** @var string $callSign */
    protected $callSign;

    /** @var string $affiliateCallSign */
    protected $affiliateCallSign;

    /** @var string $uri */
    protected $uri;


    /**
     * @param string $number
     * @param string $callSign
     * @param string $affiliateCallSign
     * @param string $uri
     */
    public function __construct($number = null, $callSign = null, $affiliateCallSign = null, $uri = null) {
        $this->setNumber($number);
        $this->setCallSign($callSign);
        $this->setAffiliateCallSign($affiliateCallSign);
        $this->setUri($uri);
    }

    /**
     * @return Channel
     */
    public static function create() {
        return new Channel();
    }

	/**
	 * @param  array $data
	 * @return Channel
	 * @throws InvalidArgumentException
	 */
	public static function createFromArray($data) {
		$number = isset($data['number']) ? $data['number'] : null;
		$callSign = isset($data['callSign']) ? $data['callSign'] : null;
		$affiliateCallSign = isset($data['affiliateCallSign']) ? $data['affiliateCallSign'] : null;
		$uri = isset($data['uri']) ? $data['uri'] : null;

		if(is_null($number) && is_null($callSign) && is_null($affiliateCallSign) && is_null($uri)) {
			throw new InvalidArgumentException('Either number, callSign, affiliateCallSign or uri must be given.');
		}

		return new Channel($number, $callSign, $affiliateCallSign, $uri);
	}


    /**
     * @return string
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * @param string $number
     * @return Channel
     */
    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallSign() {
        return $this->callSign;
    }

    /**
     * @param string $callSign
     * @return Channel
     */
    public function setCallSign($callSign) {
        $this->callSign = $callSign;
        return $this;
    }

    /**
     * @return string
     */
    public function getAffiliateCallSign() {
        return $this->affiliateCallSign;
    }

    /**
     * @param string $affiliateCallSign
     * @return Channel
     */
    public function setAffiliateCallSign($affiliateCallSign) {
        $this->affiliateCallSign = $affiliateCallSign;
        return $this;
    }

    /**
     * @return string
     */
    public function getUri() {
        return $this->uri;
    }

    /**
     * @param string $uri
     * @return Channel
     */
    public function setUri($uri) {
        $this->uri = $uri;
        return $this;
    }


	/**
	 * @return array
     * @throws InvalidArgumentException
	 */
	public function render() {
	    $rendered = [];
        $number = $this->getNumber();
        $callSign = $this->getCallSign();
        $affiliateCallSign = $this->getAffiliateCallSign();
        $uri = $this->getUri();

        if(is_null($number) && is_null($callSign) && is_null($affiliateCallSign) && is_null($uri)) {
            throw new InvalidArgumentException('Either number, callSign, affiliateCallSign or uri must be given.');
        }

        if(!is_null($number)) {
            $rendered['number'] = $number;
        }

        if(!is_null($callSign)) {
            $rendered['callSign'] = $callSign;
        }

        if(!is_null($affiliateCallSign)) {
            $rendered['affiliateCallSign'] = $affiliateCallSign;
        }

        if(!is_null($uri)) {
            $rendered['uri'] = $uri;
        }

        return $rendered;
	}
}
