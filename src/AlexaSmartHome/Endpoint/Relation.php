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
				'AdjustBrightness' => ['brightnessDelta'],
				'SetBrightness' => ['brightness'],
			],
			'properties' => ['brightness']
		],

        'Alexa.CameraStreamController' => [
            'directives' => [
                'InitializeCameraStreams' => ['cameraStreamConfigurations'],
            ],
            'properties' => [],
            'extraProperties' => ['cameraStreamConfigurations'],
        ],

        'Alexa.ChannelController' => [
            'directives' => [
                'ChangeChannel' => ['channel'],
                'SkipChannels' => ['channelCount'],
            ],
            'properties' => ['channel']
        ],

		'Alexa.ColorController' => [
			'directives' => [
				'SetColor' => ['color'],
			],
			'properties' => ['color']
		],

		'Alexa.ColorTemperatureController' => [
			'directives' => [
				'DecreaseColorTemperature' => [],
				'IncreaseColorTemperature' => [],
				'SetColorTemperature' => ['colorTemperatureInKelvin'],
			],
			'properties' => ['colorTemperatureInKelvin']
		],

        'Alexa.EndpointHealth' => [
            'directives' => [],
            'properties' => ['connectivity']
        ],

        'Alexa.InputController' => [
            'directives' => [
                'SelectInput' => ['input'],
            ],
            'properties' => ['input']
        ],

        'Alexa.LockController' => [
            'directives' => [
                'Lock' => [],
                'Unlock' => [],
            ],
            'properties' => ['lockState']
        ],

        'Alexa.PercentageController' => [
            'directives' => [
                'SetPercentage' => ['percentage'],
                'AdjustPercentage' => ['percentageDelta'],
            ],
            'properties' => ['percentage']
        ],

        'Alexa.PowerController' => [
            'directives' => [
                'TurnOn' => [],
                'TurnOff' => [],
            ],
            'properties' => ['powerState']
        ],

        'Alexa.PowerLevelController' => [
            'directives' => [
                'SetPowerLevel' => ['powerLevel'],
                'AdjustPowerLevel' => ['powerLevelDelta'],
            ],
            'properties' => ['powerLevel']
        ],

        'Alexa.SceneController' => [
            'directives' => [
                'Activation' => [],
                'Deactivate' => [],
            ],
            'properties' => [],
            'extraProperties' => ['supportsDeactivation', 'proactivelyReported'],
        ],

        'Alexa.Speaker' => [
            'directives' => [
                'SetVolume' => ['volume'],
                'AdjustVolume' => ['volume', 'volumeDefault'],
                'SetMute' => ['mute'],
            ],
            'properties' => ['volume', 'muted']
        ],

        'Alexa.StepSpeaker' => [
            'directives' => [
                'AdjustVolume' => ['volumeSteps'],
                'SetMute' => ['mute'],
            ],
            'properties' => []
        ],

        'Alexa.TemperatureSensor' => [
            'directives' => [],
            'properties' => ['temperature']
        ],

        'Alexa.ThermostatController' => [
            'directives' => [
                'SetTargetTemperature' => ['targetSetpoint', 'lowerSetpoint', 'upperSetpoint'],
                'AdjustTargetTemperature' => ['targetSetpointDelta'],
                'SetThermostatMode' => ['thermostatMode'],
            ],
            'properties' => ['targetSetpoint', 'lowerSetpoint', 'upperSetpoint', 'thermostatMode']
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
