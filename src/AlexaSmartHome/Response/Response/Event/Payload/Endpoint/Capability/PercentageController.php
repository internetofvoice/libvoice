<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event\Payload\Endpoint\Capability;

/**
 * Class PercentageController
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class PercentageController extends AbstractCapability {
	/** @var array $reportableProperties */
	const reportableProperties = ['percentage'];

	/** @var string $interface */
	protected $interface = 'Alexa.PercentageController';


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
