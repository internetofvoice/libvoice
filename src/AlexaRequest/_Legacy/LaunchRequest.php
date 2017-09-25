<?php

namespace InternetOfVoice\LibVoice\AlexaRequest;

class LaunchRequest extends Request
{
    public $applicationId;

    /**
     * LaunchRequest constructor.
     * @param string $rawData
     */
    public function __construct($rawData)
    {
        parent::__construct($rawData);
        $data = $this->data;

        $this->applicationId = $data['session']['application']['applicationId'];
    }
}
