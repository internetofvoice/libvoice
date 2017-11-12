<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Capability;

/**
 * Class PowerController
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class PowerController extends AbstractCapability {
	/** @var array $reportableProperties */
	const reportableProperties = ['powerState'];

	/** @var string $interface */
	protected $interface = 'Alexa.PowerController';


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
