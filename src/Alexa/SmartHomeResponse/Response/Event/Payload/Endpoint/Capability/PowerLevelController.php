<?php

namespace InternetOfVoice\LibVoice\Alexa\SmartHomeResponse\Response\Event\Payload\Endpoint\Capability;

/**
 * Class PowerLevelController
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class PowerLevelController  extends AbstractCapability {
	/** @var array $reportableProperties */
	const reportableProperties = ['powerLevel'];


	/**
	 * @param array $properties
	 * @param bool  $proactivelyReported
	 * @param bool  $retrievable
	 */
	public function __construct($properties = [], $proactivelyReported = false, $retrievable = false) {
		parent::__construct();

		$this->type = 'AlexaInterface';
		$this->interface = 'Alexa.PowerLevelController ';
		$this->version = '3';
		$this->properties = new Properties(self::reportableProperties, $properties, $proactivelyReported, $retrievable);
	}


	/**
	 * @return array
	 */
	public function render() {
		$rendered = [
			'type' => $this->getType(),
			'interface' => $this->getInterface(),
			'version' => $this->getVersion(),
			'properties' => $this->getProperties()->render(),
		];

		return $rendered;
	}
}
