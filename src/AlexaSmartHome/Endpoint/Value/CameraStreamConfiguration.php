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

    /** @var Resolution[] $resolutions */
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
    public function __construct(array $configurationData = []) {
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
    public static function create(): CameraStreamConfiguration {
        return new CameraStreamConfiguration();
    }

	/**
	 * @param  array $data
	 *
	 * @return CameraStreamConfiguration
	 */
	public static function createFromArray(array $data): CameraStreamConfiguration {
		return new CameraStreamConfiguration($data);
	}


    /**
     * @return array
     */
    public function getProtocols(): array {
        return $this->protocols;
    }

    /**
     * @param array $protocols
     *
     * @return CameraStreamConfiguration
     */
    public function setProtocols(array $protocols): CameraStreamConfiguration {
        foreach($protocols as $protocol) {
            $this->addProtocol($protocol);
        }

        return $this;
    }

    /**
     * @param string $protocol
     *
     * @return CameraStreamConfiguration
     */
    public function addProtocol(string $protocol): CameraStreamConfiguration {
        array_push($this->protocols, $protocol);

        return $this;
    }


    /**
     * @return Resolution[]
     */
    public function getResolutions(): array {
        return $this->resolutions;
    }

    /**
     * @param Resolution[] $resolutions
     *
     * @return CameraStreamConfiguration
     */
    public function setResolutions(array $resolutions): CameraStreamConfiguration {
        foreach($resolutions as $resolution) {
            $this->addResolution($resolution->getWidth(), $resolution->getHeight());
        }

        return $this;
    }

    /**
     * @param  int $width
     * @param  int $height
     *
     * @return CameraStreamConfiguration
     */
    public function addResolution(int $width, int $height): CameraStreamConfiguration {
        array_push($this->resolutions, new Resolution($width, $height));

        return $this;
    }


    /**
     * @return array
     */
    public function getAuthorizationTypes(): array {
        return $this->authorizationTypes;
    }

    /**
     * @param  array $authorizationTypes
     *
     * @return CameraStreamConfiguration
     */
    public function setAuthorizationTypes(array $authorizationTypes): CameraStreamConfiguration {
        foreach($authorizationTypes as $authorizationType) {
            $this->addAuthorizationType($authorizationType);
        }

        return $this;
    }

    /**
     * @param  string $authorizationType
     *
     * @return CameraStreamConfiguration
     *
     * @throws InvalidArgumentException
     */
    public function addAuthorizationType(string $authorizationType): CameraStreamConfiguration {
        if(!in_array($authorizationType, self::validAuthorizationTypes)) {
	        throw new InvalidArgumentException('Invalid AuthorizationType: ' . $authorizationType);
        }

	    array_push($this->authorizationTypes, $authorizationType);

	    return $this;
    }


    /**
     * @return array
     */
    public function getVideoCodecs(): array {
        return $this->videoCodecs;
    }

    /**
     * @param  array $videoCodecs
     *
     * @return CameraStreamConfiguration
     */
    public function setVideoCodecs(array $videoCodecs): CameraStreamConfiguration {
        foreach($videoCodecs as $videoCodec) {
            $this->addVideoCodec($videoCodec);
        }

        return $this;
    }

    /**
     * @param  string $videoCodec
     *
     * @return CameraStreamConfiguration
     *
     * @throws InvalidArgumentException
     */
    public function addVideoCodec(string $videoCodec): CameraStreamConfiguration {
        if(!in_array($videoCodec, self::validVideoCodecs)) {
	        throw new InvalidArgumentException('Invalid VideoCodec: ' . $videoCodec);
        }

	    array_push($this->videoCodecs, $videoCodec);

        return $this;
    }


    /**
     * @return array
     */
    public function getAudioCodecs(): array {
        return $this->audioCodecs;
    }

    /**
     * @param  array $audioCodecs
     *
     * @return CameraStreamConfiguration
     */
    public function setAudioCodecs(array $audioCodecs): CameraStreamConfiguration {
        foreach($audioCodecs as $audioCodec) {
            $this->addAudioCodec($audioCodec);
        }

        return $this;
    }

    /**
     * @param  string $audioCodec
     *
     * @return CameraStreamConfiguration
     *
     * @throws InvalidArgumentException
     */
    public function addAudioCodec(string $audioCodec): CameraStreamConfiguration {
        if(!in_array($audioCodec, self::validAudioCodecs)) {
	        throw new InvalidArgumentException('Invalid AudioCodec: ' . $audioCodec);
        }

	    array_push($this->audioCodecs, $audioCodec);

        return $this;
    }


	/**
	 * @return array
	 */
	public function render(): array {
		$rendered = [
			'protocols'          => $this->getProtocols(),
			'authorizationTypes' => $this->getAuthorizationTypes(),
			'videoCodecs'        => $this->getVideoCodecs(),
			'audioCodecs'        => $this->getAudioCodecs(),
		];

		$renderedResolutions = array();
        foreach($this->getResolutions() as $resolution) {
            array_push($renderedResolutions, $resolution->render());
		}

		$rendered['resolutions'] = $renderedResolutions;

		return $rendered;
	}
}
