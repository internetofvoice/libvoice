<?php

namespace InternetOfVoice\LibVoice\AlexaRequest;

class SessionEndedRequest extends Request
{
    public $reason;

    /**
     * SessionEndedRequest constructor.
     * @param string $rawData
     */
    public function __construct($rawData)
    {
        parent::__construct($rawData);

        $this->reason = $this->data['request']['reason'];
    }
}
