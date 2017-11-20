<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Request\Request\Directive;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Relation;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\CameraStreamConfiguration;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\Channel;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\Color;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\Temperature;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Scope\Scope;

/**
 * Class Payload
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Payload extends Relation {
	/** @var Scope $scope */
	protected $scope;

	/** @var mixed $value */
	protected $value;


	/**
	 * @param array  $payloadData
	 * @param string $headerNamespace
	 * @param string $headerName
	 */
	public function __construct($payloadData, $headerNamespace = '', $headerName = '') {
		if(isset($payloadData['scope'])) {
			$this->scope = new Scope($payloadData['scope']);
		}

		// check for possible value
		if($this->isInterfaceAvailable($headerNamespace)) {
			$this->extractValue($payloadData, $headerNamespace, $headerName);
		}
	}

	public function extractValue($payloadData, $interface, $directive) {
		$directives = $this->getDirectivesFor($interface);
		if(array_key_exists($directive, $directives)) {
			$properties = $directives[$directive];
			foreach($properties as $propertyName => $propertyType) {
				if(isset($payloadData[$propertyName])) {
					$value = $payloadData[$propertyName];
					$type = $propertyType;

					switch($type) {
						case 'int':
							$this->value = intval($value);
						break;

						case 'bool':
							$this->value = boolval($value);
						break;

						case 'string':
							$this->value = strval($value);
						break;

						case 'Channel':
							$this->value = Channel::createFromArray($value);
						break;

						case 'Color':
							$this->value = Color::createFromArray($value);
						break;

						case 'Temperature':
							$this->value = Temperature::createFromArray($value);
						break;

						case 'CameraStreamConfigurations':
							$configurations = array();
							foreach($value as $v) {
								array_push($configurations, CameraStreamConfiguration::createFromArray($v));
							}

							$this->value = $configurations;
						break;
					}
				}
			}
		}
	}

	/**
	 * @return Scope
	 */
	public function getScope() {
		return $this->scope;
	}

	/**
	 * @return mixed
	 */
	public function getValue() {
		return $this->value;
	}
}
