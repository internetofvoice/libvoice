<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value;

use \InvalidArgumentException;

/**
 * Class CameraStreamConfiguration
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class CameraStreamConfiguration {
    /** @var array $protocols */
    protected $protocols = [];

    /** @var array $resolutions */
    protected $resolutions = [];

    /** @var array validAuthorizationTypes */
    const validAuthorizationTypes = ['BASIC', 'DIGEST', 'NONE'];

    /** @var array $authorizationTypes */
    protected $authorizationTypes = [];

    /** @var array validVideoCodecs */
    const validVideoCodecs = ['H264', 'MPEG2', 'MJPEG', 'JPG'];

    /** @var array $videoCodecs */
    protected $videoCodecs = [];

    /** @var array validAudioCodecs */
    const validAudioCodecs = ['G711', 'AAC', 'NONE'];

    /** @var array $audioCodecs */
    protected $audioCodecs = [];


    /**
     * @param array $configurationData
     */
    public function __construct($configurationData = []) {
        if(isset($configurationData['protocols'])) {
            $this->setProtocols($configurationData['protocols']);
        }

        if(isset($configurationData['resolutions'])) {
            $this->setResolutions($configurationData['resolutions']);
        }

        if(isset($configurationData['authorizationTypes'])) {
            $this->setAuthorizationTypes($configurationData['authorizationTypes']);
        }

        if(isset($configurationData['audioCodecs'])) {
            $this->setAudioCodecs($configurationData['audioCodecs']);
        }

        if(isset($configurationData['videoCodecs'])) {
            $this->setVideoCodecs($configurationData['videoCodecs']);
        }
    }

    /**
     * @return CameraStreamConfiguration
     */
    public static function create() {
        return new CameraStreamConfiguration();
    }

	/**
	 * @param  array $data
	 * @return CameraStreamConfiguration
	 */
	public static function createFromArray($data) {
		return new CameraStreamConfiguration($data);
	}


    /**
     * @return array
     */
    public function getProtocols() {
        return $this->protocols;
    }

    /**
     * @param array $protocols
     * @return CameraStreamConfiguration
     */
    public function setProtocols($protocols) {
        foreach($protocols as $protocol) {
            $this->addProtocol($protocol);
        }

        return $this;
    }

    /**
     * @param string $protocol
     * @return CameraStreamConfiguration
     */
    public function addProtocol($protocol) {
        array_push($this->protocols, $protocol);

        return $this;
    }


    /**
     * @return array
     */
    public function getResolutions() {
        return $this->resolutions;
    }

    /**
     * @param array $resolutions
     * @return CameraStreamConfiguration
     */
    public function setResolutions($resolutions) {
        foreach($resolutions as $resolution) {
            $this->addResolution($resolution['width'], $resolution['height']);
        }

        return $this;
    }

    /**
     * @param int $width
     * @param int $height
     * @return CameraStreamConfiguration
     */
    public function addResolution($width, $height) {
        array_push($this->resolutions, ['width' => $width, 'height' => $height]);

        return $this;
    }


    /**
     * @return array
     */
    public function getAuthorizationTypes() {
        return $this->authorizationTypes;
    }

    /**
     * @param array $authorizationTypes
     * @return CameraStreamConfiguration
     */
    public function setAuthorizationTypes($authorizationTypes) {
        foreach($authorizationTypes as $authorizationType) {
            $this->addAuthorizationType($authorizationType);
        }

        return $this;
    }

    /**
     * @param string $authorizationType
     * @return CameraStreamConfiguration
     * @throws InvalidArgumentException
     */
    public function addAuthorizationType($authorizationType) {
        if(in_array($authorizationType, self::validAuthorizationTypes)) {
            array_push($this->authorizationTypes, $authorizationType);
        } else {
            throw new InvalidArgumentException('Invalid AuthorizationType: ' . $authorizationType);
        }

        return $this;
    }


    /**
     * @return array
     */
    public function getVideoCodecs() {
        return $this->videoCodecs;
    }

    /**
     * @param array $videoCodecs
     * @return CameraStreamConfiguration
     */
    public function setVideoCodecs($videoCodecs) {
        foreach($videoCodecs as $videoCodec) {
            $this->addVideoCodec($videoCodec);
        }

        return $this;
    }

    /**
     * @param string $videoCodec
     * @return CameraStreamConfiguration
     * @throws InvalidArgumentException
     */
    public function addVideoCodec($videoCodec) {
        if(in_array($videoCodec, self::validVideoCodecs)) {
            array_push($this->videoCodecs, $videoCodec);
        } else {
            throw new InvalidArgumentException('Invalid VideoCodec: ' . $videoCodec);
        }

        return $this;
    }


    /**
     * @return array
     */
    public function getAudioCodecs() {
        return $this->audioCodecs;
    }

    /**
     * @param array $audioCodecs
     * @return CameraStreamConfiguration
     */
    public function setAudioCodecs($audioCodecs) {
        foreach($audioCodecs as $audioCodec) {
            $this->addAudioCodec($audioCodec);
        }

        return $this;
    }

    /**
     * @param string $audioCodec
     * @return CameraStreamConfiguration
     * @throws InvalidArgumentException
     */
    public function addAudioCodec($audioCodec) {
        if(in_array($audioCodec, self::validAudioCodecs)) {
            array_push($this->audioCodecs, $audioCodec);
        } else {
            throw new InvalidArgumentException('Invalid AudioCodec: ' . $audioCodec);
        }

        return $this;
    }


	/**
	 * @return array
	 */
	public function render() {
		$rendered = [
            'protocols' => $this->getProtocols(),
            'resolutions' => $this->getResolutions(),
            'authorizationTypes' => $this->getAuthorizationTypes(),
            'videoCodecs' => $this->getVideoCodecs(),
            'audioCodecs' => $this->getAudioCodecs(),
		];

		return $rendered;
	}
}
