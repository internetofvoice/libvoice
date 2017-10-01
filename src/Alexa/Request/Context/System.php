<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Context;

use InternetOfVoice\LibVoice\Alexa\Request\Application;
use InternetOfVoice\LibVoice\Alexa\Request\Context\System\Device;
use InternetOfVoice\LibVoice\Alexa\Request\User;

class System {
    /** @var Application $application */
    protected $application;

    /** @var User $user */
    protected $user;

    /** @var Device $device */
    protected $device;

    /** @var string $apiEndpoint */
    protected $apiEndpoint;

    /**
     * @param array $systemData
     */
    public function __construct($systemData) {
        if(isset($systemData['application'])) {
            $this->application = new Application($systemData['application']);
        }

        if(isset($systemData['user'])) {
            $this->user = new User($systemData['user']);
        }

        if(isset($systemData['device'])) {
            $this->device = new Device($systemData['device']);
        }

        if(isset($systemData['apiEndpoint'])) {
            $this->apiEndpoint = $systemData['apiEndpoint'];
        }
    }


    /**
     * @return Application
     */
    public function getApplication() {
        return $this->application;
    }

    /**
     * @return User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @return Device
     */
    public function getDevice() {
        return $this->device;
    }

    /**
     * @return string
     */
    public function getApiEndpoint() {
        return $this->apiEndpoint;
    }
}
