<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Request\Request\Directive;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Relation;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\CameraStream;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\Channel;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\Color;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\Temperature;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\ThermostatMode;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Scope\Grant;
use \InternetOfVoice\LibVoice\AlexaSmartHome\Scope\Grantee;
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

	/** @var array $values */
	protected $values = [];

	/** @var Grant $grant */
	protected $grant;

	/** @var Grantee $grantee */
	protected $grantee;


	/**
	 * @param array  $payloadData
	 * @param string $headerNamespace
	 * @param string $headerName
	 */
	public function __construct(array $payloadData, string $headerNamespace = '', string $headerName = '') {
		if(isset($payloadData['scope'])) {
			$this->scope = new Scope($payloadData['scope']);
		}

		// check for possible value
		if($this->isInterfaceAvailable($headerNamespace)) {
			$this->extractValues($payloadData, $headerNamespace, $headerName);
		}

		if(isset($payloadData['grant'])) {
			$this->grant = new Grant($payloadData['grant']);
		}

		if(isset($payloadData['grantee'])) {
			$this->grantee = new Grantee($payloadData['grantee']);
		}
	}

	/**
	 * @param array  $payloadData
	 * @param string $interface
	 * @param string $directive
	 */
	public function extractValues(array $payloadData, string $interface, string $directive) {
		$directives = $this->getDirectivesFor($interface);
		if(array_key_exists($directive, $directives)) {
			$properties = $directives[$directive];
			foreach($properties as $propertyName => $propertyType) {
				if(isset($payloadData[$propertyName])) {
					$value = $payloadData[$propertyName];
					$type  = $propertyType;

					switch($type) {
						case 'int':
							$this->setValue($propertyName, intval($value));
						break;

						case 'bool':
							$this->setValue($propertyName, boolval($value));
						break;

						case 'string':
							$this->setValue($propertyName, strval($value));
						break;

						case 'Channel':
							$this->setValue($propertyName, Channel::createFromArray($value));
						break;

						case 'Color':
							$this->setValue($propertyName, Color::createFromArray($value));
						break;

						case 'Temperature':
							$this->setValue($propertyName, Temperature::createFromArray($value));
						break;

						case 'ThermostatMode':
							$this->setValue($propertyName, ThermostatMode::createFromArray($value));
						break;

						case 'CameraStreams':
							$configurations = [];
							foreach($value as $v) {
								array_push($configurations, CameraStream::createFromArray($v));
							}

							$this->setValue($propertyName, $configurations);
						break;
					}
				}
			}
		}
	}

	/**
	 * @return null|Scope
	 */
	public function getScope(): ?Scope {
		return $this->scope;
	}

	/**
	 * @param  string $key
	 * @param  mixed  $value
	 *
	 * @return Payload
	 */
	protected function setValue(string $key, $value): Payload {
		$this->values[$key] = $value;

		return $this;
	}

	/**
	 * @param  string $key
	 *
	 * @return mixed
	 */
	public function getValue(string $key) {
		return isset($this->values[$key]) ? $this->values[$key] : null;
	}

	/**
	 * @return array
	 */
	public function getValues(): array {
		return $this->values;
	}

	/**
	 * @return null|Grant
	 */
	public function getGrant(): ?Grant {
		return $this->grant;
	}

	/**
	 * @return null|Grantee
	 */
	public function getGrantee(): ?Grantee {
		return $this->grantee;
	}
}
