<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability;

/**
 * Class CameraStreamController
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class CameraStreamController extends AbstractCapability {
	/** @var string $interface */
	protected $interface = 'Alexa.CameraStreamController';

	/** @var CameraStreamConfiguration[] $cameraStreamConfigurations */
	protected $cameraStreamConfigurations = [];


	/**
	 * @param array $cameraStreamConfigurations
	 */
	public function __construct($cameraStreamConfigurations = []) {
		parent::__construct();

		$this->setCameraStreamConfigurations($cameraStreamConfigurations);
	}


    /**
     * @return CameraStreamConfiguration[]
     */
    public function getCameraStreamConfigurations() {
        return $this->cameraStreamConfigurations;
    }

    /**
     * @param CameraStreamConfiguration[] $cameraStreamConfigurations
     * @return CameraStreamController
     */
    public function setCameraStreamConfigurations($cameraStreamConfigurations) {
        foreach($cameraStreamConfigurations as $cameraStreamConfiguration) {
            $this->addCameraStreamConfiguration($cameraStreamConfiguration);
        }

        return $this;
    }

    /**
     * @param CameraStreamConfiguration $cameraStreamConfiguration
     * @return CameraStreamController
     */
    public function addCameraStreamConfiguration($cameraStreamConfiguration) {
        array_push($this->cameraStreamConfigurations, $cameraStreamConfiguration);

        return $this;
    }


    /**
     * @return array
     */
    public function render() {
        $rendered = parent::render();

        $renderedConfigs = array();
        foreach($this->getCameraStreamConfigurations() as $config) {
            array_push($renderedConfigs, $config->render());
        }

        $rendered['cameraStreamConfigurations'] = $renderedConfigs;

        return $rendered;
    }
}
