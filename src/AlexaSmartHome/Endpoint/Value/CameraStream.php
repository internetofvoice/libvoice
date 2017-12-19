<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value;

use \DateTime;
use \InvalidArgumentException;

/**
 * Class CameraStream
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class CameraStream {
    /** @var string $uri */
    protected $uri;

    /** @var DateTime $expirationTime */
    protected $expirationTime;

    /** @var int $idleTimeoutSeconds */
    protected $idleTimeoutSeconds;

    /** @var string $protocol */
    protected $protocol;

    /** @var Resolution $resolution */
    protected $resolution;

    /** @var array validAuthorizationTypes */
    const validAuthorizationTypes = ['BASIC', 'DIGEST', 'NONE'];

    /** @var string $authorizationType */
    protected $authorizationType;

    /** @var array validVideoCodecs */
    const validVideoCodecs = ['H264', 'MPEG2', 'MJPEG', 'JPG'];

    /** @var string $videoCodec */
    protected $videoCodec;

    /** @var array validAudioCodecs */
    const validAudioCodecs = ['G711', 'AAC', 'NONE'];

    /** @var string $audioCodec */
    protected $audioCodec;


    /**
     * @param array $data
     */
    public function __construct($data = []) {
        if(isset($data['uri'])) {
            $this->setUri($data['uri']);
        }

        if(isset($data['expirationTime'])) {
            $this->setExpirationTime(new DateTime($data['expirationTime']));
        }

        if(isset($data['idleTimeoutSeconds'])) {
            $this->setIdleTimeoutSeconds($data['idleTimeoutSeconds']);
        }

        if(isset($data['protocol'])) {
            $this->setProtocol($data['protocol']);
        }

        if(isset($data['resolution'])) {
            $this->setResolution(Resolution::createFromArray($data['resolution']));
        }

        if(isset($data['authorizationType'])) {
            $this->setAuthorizationType($data['authorizationType']);
        }

        if(isset($data['videoCodec'])) {
            $this->setVideoCodec($data['videoCodec']);
        }

        if(isset($data['audioCodec'])) {
            $this->setAudioCodec($data['audioCodec']);
        }
    }

    /**
     * @return CameraStream
     */
    public static function create() {
        return new CameraStream();
    }

    /**
     * @param  array $data
     * @return CameraStream
     */
    public static function createFromArray($data) {
        return new CameraStream($data);
    }


    /**
     * @return string
     */
    public function getUri() {
        return $this->uri;
    }

    /**
     * @param  string $uri
     * @return CameraStream
     */
    public function setUri($uri) {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getExpirationTime() {
        return $this->expirationTime;
    }

    /**
     * @return string
     */
    public function getExpirationTimeAsString() {
        return $this->expirationTime->format('c');
    }

    /**
     * @param  DateTime $expirationTime
     * @return CameraStream
     * @throws InvalidArgumentException
     */
    public function setExpirationTime($expirationTime) {
        if(!is_a($expirationTime, 'DateTime')) {
            throw new InvalidArgumentException('ExpirationTime must be a DateTime object (UTC based).');
        }

        $this->expirationTime = $expirationTime;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdleTimeoutSeconds() {
        return $this->idleTimeoutSeconds;
    }

    /**
     * @param  int $idleTimeoutSeconds
     * @return CameraStream
     */
    public function setIdleTimeoutSeconds($idleTimeoutSeconds) {
        $this->idleTimeoutSeconds = $idleTimeoutSeconds;
        return $this;
    }

    /**
     * @return string
     */
    public function getProtocol() {
        return $this->protocol;
    }

    /**
     * @param  string $protocol
     * @return CameraStream
     */
    public function setProtocol($protocol) {
        $this->protocol = $protocol;
        return $this;
    }

    /**
     * @return Resolution
     */
    public function getResolution() {
        return $this->resolution;
    }

    /**
     * @param  Resolution $resolution
     * @return CameraStream
     */
    public function setResolution($resolution) {
        $this->resolution = $resolution;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorizationType() {
        return $this->authorizationType;
    }

    /**
     * @param  string $authorizationType
     * @return CameraStream
     * @throws InvalidArgumentException
     */
    public function setAuthorizationType($authorizationType) {
        if(!in_array($authorizationType, self::validAuthorizationTypes)) {
            throw new InvalidArgumentException('Invalid AuthorizationType: ' . $authorizationType);
        }

        $this->authorizationType = $authorizationType;
        return $this;
    }

    /**
     * @return string
     */
    public function getVideoCodec() {
        return $this->videoCodec;
    }

    /**
     * @param  string $videoCodec
     * @return CameraStream
     * @throws InvalidArgumentException
     */
    public function setVideoCodec($videoCodec) {
        if(!in_array($videoCodec, self::validVideoCodecs)) {
            throw new InvalidArgumentException('Invalid AuthorizationType: ' . $videoCodec);
        }

        $this->videoCodec = $videoCodec;
        return $this;
    }

    /**
     * @return string
     */
    public function getAudioCodec() {
        return $this->audioCodec;
    }

    /**
     * @param  string $audioCodec
     * @return CameraStream
     * @throws InvalidArgumentException
     */
    public function setAudioCodec($audioCodec) {
        if(!in_array($audioCodec, self::validAudioCodecs)) {
            throw new InvalidArgumentException('Invalid AuthorizationType: ' . $audioCodec);
        }

        $this->audioCodec = $audioCodec;
        return $this;
    }


    /**
     * @return array
     */
    public function render() {
        $rendered = [
            'uri' => $this->getUri(),
            'expirationTime' => $this->getExpirationTimeAsString(),
            'protocol' => $this->getProtocol(),
            'resolution' => $this->getResolution()->render(),
            'authorizationType' => $this->getAuthorizationType(),
            'videoCodec' => $this->getVideoCodec(),
            'audioCodec' => $this->getAudioCodec(),
        ];

        if($this->getIdleTimeoutSeconds()) {
	        $rendered['idleTimeoutSeconds'] = $this->getIdleTimeoutSeconds();
        }

        return $rendered;
    }
}
