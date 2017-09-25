<?php

namespace InternetOfVoice\LibVoice\AlexaRequest\Context\System;

use stdClass;

class Device {
    /** @var string $deviceId */
    protected $deviceId;

    /** @var stdClass $supportedInterfaces */
    protected $supportedInterfaces;


    /**
     * @param array $deviceData
     */
    public function __construct($deviceData) {
        if(isset($deviceData['deviceId'])) {
            $this->deviceId = $deviceData['deviceId'];
        }

        if(isset($deviceData['supportedInterfaces'])) {
            $this->supportedInterfaces = json_decode(json_encode($deviceData['supportedInterfaces']));
        }
    }


    /**
     * @return string
     */
    public function getDeviceId() {
        return $this->deviceId;
    }

    /**
     * @return stdClass
     */
    public function getSupportedInterfaces() {
        return $this->supportedInterfaces;
    }
}
