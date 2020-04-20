<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value;

use \DateTime;
use \Exception;
use \InvalidArgumentException;

/**
 * Class CameraStream
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class CameraStream {
    /** @var string $uri */
    protected $uri = '';

    /** @var DateTime $expirationTime */
    protected $expirationTime;

    /** @var int $idleTimeoutSeconds */
    protected $idleTimeoutSeconds = 0;

    /** @var string $protocol */
    protected $protocol = '';

    /** @var Resolution $resolution */
    protected $resolution;

    /** @var array validAuthorizationTypes */
    const validAuthorizationTypes = ['BASIC', 'DIGEST', 'NONE'];

    /** @var string $authorizationType */
    protected $authorizationType = 'NONE';

    /** @var array validVideoCodecs */
    const validVideoCodecs = ['H264', 'MPEG2', 'MJPEG', 'JPG'];

    /** @var string $videoCodec */
    protected $videoCodec = 'H264';

    /** @var array validAudioCodecs */
    const validAudioCodecs = ['G711', 'AAC', 'NONE'];

    /** @var string $audioCodec */
    protected $audioCodec = 'AAC';


    /**
     * @param array $data
     */
    public function __construct(array $data = []) {
        if(isset($data['uri'])) {
            $this->setUri($data['uri']);
        }

        if(isset($data['expirationTime'])) {
	        try {
		        $this->setExpirationTime(new DateTime($data['expirationTime']));
	        } catch(Exception $e) {
	        	// intentionally left blank
	        }
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
    public static function create(): CameraStream {
        return new CameraStream();
    }

    /**
     * @param  array $data
     * @return CameraStream
     */
    public static function createFromArray(array $data): CameraStream {
        return new CameraStream($data);
    }


    /**
     * @return string
     */
    public function getUri(): string {
        return $this->uri;
    }

    /**
     * @param  string $uri
     * @return CameraStream
     */
    public function setUri(string $uri): CameraStream {
        $this->uri = $uri;

        return $this;
    }

    /**
     * @return null|DateTime
     */
    public function getExpirationTime(): ?DateTime {
        return $this->expirationTime;
    }

    /**
     * @return null|string
     */
    public function getExpirationTimeAsString() {
    	return is_null($this->expirationTime) ? null : $this->expirationTime->format('c');
    }

    /**
     * @param  DateTime $expirationTime
     *
     * @return CameraStream
     *
     * @throws InvalidArgumentException
     */
    public function setExpirationTime(DateTime $expirationTime): CameraStream {
        $this->expirationTime = $expirationTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getIdleTimeoutSeconds(): int {
        return $this->idleTimeoutSeconds;
    }

    /**
     * @param  int $idleTimeoutSeconds
     *
     * @return CameraStream
     */
    public function setIdleTimeoutSeconds(int $idleTimeoutSeconds): CameraStream {
        $this->idleTimeoutSeconds = $idleTimeoutSeconds;
        return $this;
    }

    /**
     * @return string
     */
    public function getProtocol(): string {
        return $this->protocol;
    }

    /**
     * @param  string $protocol
     *
     * @return CameraStream
     */
    public function setProtocol(string $protocol): CameraStream {
        $this->protocol = $protocol;

        return $this;
    }

    /**
     * @return null|Resolution
     */
    public function getResolution(): ?Resolution {
        return $this->resolution;
    }

    /**
     * @param  Resolution $resolution
     *
     * @return CameraStream
     */
    public function setResolution(Resolution $resolution): CameraStream {
        $this->resolution = $resolution;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorizationType(): string {
        return $this->authorizationType;
    }

    /**
     * @param  string $authorizationType
     *
     * @return CameraStream
     *
     * @throws InvalidArgumentException
     */
    public function setAuthorizationType(string $authorizationType): CameraStream {
        if(!in_array($authorizationType, self::validAuthorizationTypes)) {
            throw new InvalidArgumentException('Invalid AuthorizationType: ' . $authorizationType);
        }

        $this->authorizationType = $authorizationType;

        return $this;
    }

    /**
     * @return string
     */
    public function getVideoCodec(): string {
        return $this->videoCodec;
    }

    /**
     * @param  string $videoCodec
     *
     * @return CameraStream
     *
     * @throws InvalidArgumentException
     */
    public function setVideoCodec(string $videoCodec): CameraStream {
        if(!in_array($videoCodec, self::validVideoCodecs)) {
            throw new InvalidArgumentException('Invalid AuthorizationType: ' . $videoCodec);
        }

        $this->videoCodec = $videoCodec;

        return $this;
    }

    /**
     * @return string
     */
    public function getAudioCodec(): string {
        return $this->audioCodec;
    }

    /**
     * @param  string $audioCodec
     *
     * @return CameraStream
     *
     * @throws InvalidArgumentException
     */
    public function setAudioCodec(string $audioCodec): CameraStream {
        if(!in_array($audioCodec, self::validAudioCodecs)) {
            throw new InvalidArgumentException('Invalid AuthorizationType: ' . $audioCodec);
        }

        $this->audioCodec = $audioCodec;

        return $this;
    }


    /**
     * @return array
     */
    public function render(): array {
        $rendered = [
	        'uri'               => $this->getUri(),
	        'expirationTime'    => $this->getExpirationTimeAsString(),
	        'protocol'          => $this->getProtocol(),
	        'resolution'        => $this->getResolution()->render(),
	        'authorizationType' => $this->getAuthorizationType(),
	        'videoCodec'        => $this->getVideoCodec(),
	        'audioCodec'        => $this->getAudioCodec(),
        ];

        if($this->getIdleTimeoutSeconds()) {
	        $rendered['idleTimeoutSeconds'] = $this->getIdleTimeoutSeconds();
        }

        return $rendered;
    }
}
