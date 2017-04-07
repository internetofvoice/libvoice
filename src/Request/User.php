<?php

namespace Alexa\Request;

class User
{
    public $userId;
    public $accessToken;

    /**
     * User constructor.
     * @param array $data
     */
    public function __construct($data)
    {
        $this->userId = isset($data['userId']) ? $data['userId'] : null;
        $this->accessToken = isset($data['accessToken']) ? $data['accessToken'] : null;
    }
}
