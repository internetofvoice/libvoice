<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability;

use \InvalidArgumentException;

/**
 * Class PlaybackController
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class PlaybackController extends AbstractCapability {
	/** @var string $interface */
	protected $interface = 'Alexa.PlaybackController';

	/** @var array $supportedOperations */
	protected $supportedOperations;

    /** @var array validOperations */
    const validOperations = ['Play', 'Pause', 'Stop', 'StartOver', 'Previous', 'Next', 'Rewind', 'FastForward'];


	/**
	 * @param array $supportedOperations
	 */
	public function __construct($supportedOperations = []) {
		parent::__construct();

        $this->setSupportedOperations($supportedOperations);
	}


    /**
     * @return array
     */
    public function getSupportedOperations() {
        return $this->supportedOperations;
    }

    /**
     * @param array $supportedOperations
     * @return PlaybackController
     */
    public function setSupportedOperations($supportedOperations) {
        foreach($supportedOperations as $supportedOperation) {
            $this->addSupportedOperation($supportedOperation);
        }

        return $this;
    }

    /**
     * @param array $supportedOperation
     * @return PlaybackController
     * @throws InvalidArgumentException
     */
    public function addSupportedOperation($supportedOperation) {
        if(in_array($supportedOperation, self::validOperations)) {
            array_push($this->supportedOperations, $supportedOperation);
        } else {
            throw new InvalidArgumentException('Invalid operation: ' . $supportedOperation);
        }

        return $this;
    }


    /**
     * @return array
     */
    public function render() {
        $rendered = parent::render();

        $rendered['supportedOperations'] = $this->getSupportedOperations();

        return $rendered;
    }
}
