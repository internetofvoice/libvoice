<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event\Payload\Endpoint\Capability;

/**
 * Class TemperatureSensor
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class TemperatureSensor extends AbstractCapability {
	/** @var array $reportableProperties */
	const reportableProperties = ['temperature'];

	/** @var string $interface */
	protected $interface = 'Alexa.TemperatureSensor';


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
