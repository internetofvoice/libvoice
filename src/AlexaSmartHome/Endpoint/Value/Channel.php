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
    protected $number = '';

    /** @var string $callSign */
    protected $callSign = '';

    /** @var string $affiliateCallSign */
    protected $affiliateCallSign = '';

    /** @var string $uri */
    protected $uri = '';


    /**
     * @param string $number
     * @param string $callSign
     * @param string $affiliateCallSign
     * @param string $uri
     */
    public function __construct(string $number = '', string $callSign = '', string $affiliateCallSign = '', string $uri = '') {
        $this->setNumber($number);
        $this->setCallSign($callSign);
        $this->setAffiliateCallSign($affiliateCallSign);
        $this->setUri($uri);
    }

    /**
     * @return Channel
     */
    public static function create(): Channel {
        return new Channel();
    }

	/**
	 * @param  array $data
	 *
	 * @return Channel
	 *
	 * @throws InvalidArgumentException
	 */
	public static function createFromArray(array $data) {
		$number            = isset($data['number']) ? $data['number'] : '';
		$callSign          = isset($data['callSign']) ? $data['callSign'] : '';
		$affiliateCallSign = isset($data['affiliateCallSign']) ? $data['affiliateCallSign'] : '';
		$uri               = isset($data['uri']) ? $data['uri'] : '';

		if(!$number && !$callSign && !$affiliateCallSign && !$uri) {
			throw new InvalidArgumentException('Either number, callSign, affiliateCallSign or uri must be given.');
		}

		return new Channel($number, $callSign, $affiliateCallSign, $uri);
	}


    /**
     * @return string
     */
    public function getNumber(): string {
        return $this->number;
    }

    /**
     * @param  string $number
     *
     * @return Channel
     */
    public function setNumber(string $number): Channel {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallSign(): string {
        return $this->callSign;
    }

    /**
     * @param  string $callSign
     *
     * @return Channel
     */
    public function setCallSign(string $callSign): Channel {
        $this->callSign = $callSign;

        return $this;
    }

    /**
     * @return string
     */
    public function getAffiliateCallSign(): string {
        return $this->affiliateCallSign;
    }

    /**
     * @param  string $affiliateCallSign
     *
     * @return Channel
     */
    public function setAffiliateCallSign(string $affiliateCallSign): Channel {
        $this->affiliateCallSign = $affiliateCallSign;

        return $this;
    }

    /**
     * @return string
     */
    public function getUri(): string {
        return $this->uri;
    }

    /**
     * @param  string $uri
     *
     * @return Channel
     */
    public function setUri(string $uri): Channel {
        $this->uri = $uri;

        return $this;
    }


	/**
	 * @return array
	 *
     * @throws InvalidArgumentException
	 */
	public function render(): array {
		$rendered          = [];
		$number            = $this->getNumber();
		$callSign          = $this->getCallSign();
		$affiliateCallSign = $this->getAffiliateCallSign();
		$uri               = $this->getUri();

        if(!$number && !$callSign && !$affiliateCallSign && !$uri) {
            throw new InvalidArgumentException('Either number, callSign, affiliateCallSign or uri must be given.');
        }

        if($number) {
            $rendered['number'] = $number;
        }

        if($callSign) {
            $rendered['callSign'] = $callSign;
        }

        if($affiliateCallSign) {
            $rendered['affiliateCallSign'] = $affiliateCallSign;
        }

        if($uri) {
            $rendered['uri'] = $uri;
        }

        return $rendered;
	}
}
