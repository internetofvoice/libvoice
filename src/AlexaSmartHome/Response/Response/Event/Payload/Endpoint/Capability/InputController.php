<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Response\Response\Event\Payload\Endpoint\Capability;

/**
 * Class InputController
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class InputController extends AbstractCapability {
	/** @var array $reportableProperties */
	const reportableProperties = ['input'];

	/** @var string $interface */
	protected $interface = 'Alexa.InputController';


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
