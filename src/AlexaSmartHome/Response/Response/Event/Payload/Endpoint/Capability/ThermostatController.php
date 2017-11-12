<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event\Payload\Endpoint\Capability;

/**
 * Class ThermostatController
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ThermostatController extends AbstractCapability {
	/** @var array $reportableProperties */
	const reportableProperties = [
	    'lowerSetpoint',
	    'targetSetpoint',
	    'upperSetpoint',
	    'thermostatMode',
    ];

	/** @var string $interface */
	protected $interface = 'Alexa.ThermostatController';


	/**
	 * @param array $properties
	 * @param bool  $proactivelyReported
	 * @param bool  $retrievable
	 */
	public function __construct($properties = [], $proactivelyReported = false, $retrievable = false) {
		parent::__construct();

		$this->properties = new Properties(self::reportableProperties, $properties, $proactivelyReported, $retrievable);
	}
}
