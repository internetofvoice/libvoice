<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint;

use \InvalidArgumentException;

/**
 * Abstract Class Relation
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
abstract class Relation {
    /** @var string apiVersion */
    const apiVersion = '3';

    /** @var array relation */
	const relation = [
		'Alexa' => [
			'directives' => [],
			'properties' => []
		],

		'Alexa.BrightnessController' => [
			'directives' => [
				'AdjustBrightness' => ['brightnessDelta' => 'int'],
				'SetBrightness' => ['brightness' => 'int'],
			],
			'properties' => ['brightness' => 'int']
		],

        'Alexa.CameraStreamController' => [
            'directives' => [
                'InitializeCameraStreams' => ['cameraStreamConfigurations' => 'CameraStreamConfigurations'],
            ],
            'properties' => ['cameraStreams' => 'CameraStreams'],
            'extraProperties' => ['cameraStreamConfigurations' => 'CameraStreamConfigurations'],
        ],

        'Alexa.ChannelController' => [
            'directives' => [
                'ChangeChannel' => ['channel' => 'Channel'],
                'SkipChannels' => ['channelCount' => 'int'],
            ],
            'properties' => ['channel' => 'Channel']
        ],

		'Alexa.ColorController' => [
			'directives' => [
				'SetColor' => ['color' => 'Color'],
			],
			'properties' => ['color' => 'Color']
		],

		'Alexa.ColorTemperatureController' => [
			'directives' => [
				'DecreaseColorTemperature' => [],
				'IncreaseColorTemperature' => [],
				'SetColorTemperature' => ['colorTemperatureInKelvin' => 'int'],
			],
			'properties' => ['colorTemperatureInKelvin' => 'int']
		],

        'Alexa.EndpointHealth' => [
            'directives' => [],
            'properties' => ['connectivity' => 'string']
        ],

        'Alexa.InputController' => [
            'directives' => [
                'SelectInput' => ['input' => 'string'],
            ],
            'properties' => ['input' => 'string']
        ],

        'Alexa.LockController' => [
            'directives' => [
                'Lock' => [],
                'Unlock' => [],
            ],
            'properties' => ['lockState' => 'string']
        ],

        'Alexa.PercentageController' => [
            'directives' => [
                'SetPercentage' => ['percentage' => 'int'],
                'AdjustPercentage' => ['percentageDelta' => 'int'],
            ],
            'properties' => ['percentage' => 'int']
        ],

        'Alexa.PowerController' => [
            'directives' => [
                'TurnOn' => [],
                'TurnOff' => [],
            ],
            'properties' => ['powerState' => 'string']
        ],

        'Alexa.PowerLevelController' => [
            'directives' => [
                'SetPowerLevel' => ['powerLevel' => 'int'],
                'AdjustPowerLevel' => ['powerLevelDelta' => 'int'],
            ],
            'properties' => ['powerLevel' => 'int']
        ],

        'Alexa.SceneController' => [
            'directives' => [
                'Activation' => [],
                'Deactivate' => [],
            ],
            'properties' => [],
            'extraProperties' => ['supportsDeactivation' => 'bool', 'proactivelyReported' => 'bool'],
        ],

        'Alexa.Speaker' => [
            'directives' => [
                'SetVolume' => ['volume' => 'int'],
                'AdjustVolume' => ['volume' => 'int', 'volumeDefault' => 'bool'],
                'SetMute' => ['mute' => 'bool'],
            ],
            'properties' => ['volume' => 'int', 'muted' => 'bool']
        ],

        'Alexa.StepSpeaker' => [
            'directives' => [
                'AdjustVolume' => ['volumeSteps' => 'int'],
                'SetMute' => ['mute' => 'bool'],
            ],
            'properties' => []
        ],

        'Alexa.TemperatureSensor' => [
            'directives' => [],
            'properties' => ['temperature' => 'Temperature']
        ],

        'Alexa.ThermostatController' => [
            'directives' => [
                'SetTargetTemperature' => ['targetSetpoint' => 'Temperature', 'lowerSetpoint' => 'Temperature', 'upperSetpoint' => 'Temperature'],
                'AdjustTargetTemperature' => ['targetSetpointDelta' => 'Temperature'],
                'SetThermostatMode' => ['thermostatMode' => 'string'],
            ],
            'properties' => ['targetSetpoint' => 'Temperature', 'lowerSetpoint' => 'Temperature', 'upperSetpoint' => 'Temperature', 'thermostatMode' => 'string']
        ],
	];


    /**
     * Get API version
     *
     * @return string
     */
    public function getApiVersion() {
        return self::apiVersion;
	}

    /**
     * Check if interface is available
     *
     * @param  $interface
     * @return bool
     */
    public function isInterfaceAvailable($interface) {
        $interfaces = self::relation;

        return isset($interfaces[$interface]);
	}

	/**
     * Get directives and their properties for an interface
     *
     * @param  string $interface
     * @return array
     * @throws InvalidArgumentException
     */
    public function getDirectivesFor($interface) {
        if(!$this->isInterfaceAvailable($interface)) {
            throw new InvalidArgumentException('Unknown interface: ' . $interface);
        }

        return self::relation[$interface]['directives'];
	}

    /**
     * Get reportable properties for an interface
     *
     * @param  string $interface
     * @return array
     * @throws InvalidArgumentException
     */
    public function getPropertiesFor($interface) {
        if(!$this->isInterfaceAvailable($interface)) {
            throw new InvalidArgumentException('Unknown interface: ' . $interface);
        }

        return self::relation[$interface]['properties'];
    }

    /**
     * Get extra properties for an interface
     *
     * @param  string $interface
     * @return array
     * @throws InvalidArgumentException
     */
    public function getExtraPropertiesFor($interface) {
        if(!$this->isInterfaceAvailable($interface)) {
            throw new InvalidArgumentException('Unknown interface: ' . $interface);
        }

        $interfaceRelation = self::relation[$interface];
        if(!isset($interfaceRelation['extraProperties'])) {
            throw new InvalidArgumentException('Interface: ' . $interface . ' does not support extra properties.');
        }

        return $interfaceRelation['extraProperties'];
    }
}
