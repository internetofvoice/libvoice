<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability;

/**
 * Class SceneController
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class SceneController extends AbstractCapability {
	/** @var string $interface */
	protected $interface = 'Alexa.SceneController';

	/** @var bool $supportsDeactivation */
    protected $supportsDeactivation;

    /** @var bool $proactivelyReported */
    protected $proactivelyReported;


	/**
     * @param bool  $supportsDeactivation
	 * @param bool  $proactivelyReported
	 */
	public function __construct($supportsDeactivation = false, $proactivelyReported = false) {
		parent::__construct();

        $this->setSupportsDeactivation($supportsDeactivation);
        $this->setProactivelyReported($proactivelyReported);
	}


    /**
     * @return bool
     */
    public function isSupportsDeactivation() {
        return $this->supportsDeactivation;
    }

    /**
     * @param bool $supportsDeactivation
     * @return SceneController
     */
    public function setSupportsDeactivation($supportsDeactivation) {
        $this->supportsDeactivation = $supportsDeactivation;
        return $this;
    }

    /**
     * @return bool
     */
    public function isProactivelyReported() {
        return $this->proactivelyReported;
    }

    /**
     * @param bool $proactivelyReported
     * @return SceneController
     */
    public function setProactivelyReported($proactivelyReported) {
        $this->proactivelyReported = $proactivelyReported;
        return $this;
    }


    /**
     * @return array
     */
    public function render() {
        $rendered = parent::render();

        $rendered['supportsDeactivation'] = $this->isSupportsDeactivation();
        $rendered['proactivelyReported'] = $this->isProactivelyReported();

        return $rendered;
    }
}
