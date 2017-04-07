<?php

namespace Alexa\Request;

class Session
{
    /** @var User */
    public $user;
    public $new;
    /** @var Application */
    public $application;
    public $sessionId;
    public $attributes = array();

    /**
     * Session constructor.
     * @param array $data
     */
    public function __construct($data)
    {
        $this->user = new User($data['user']);
        $this->sessionId = isset($data['sessionId']) ? $data['sessionId'] : null;
        $this->new = isset($data['new']) ? $data['new'] : null;
        if (!$this->new && isset($data['attributes'])) {
            $this->attributes = $data['attributes'];
        }
    }

    /**
     * Remove "SessionId." prefix from the send session id, as it's invalid
     * as a PHP session id (at least for default session, on file).
     *
     * @param string $sessionId
     * @return string
     */
    protected function parseSessionId($sessionId)
    {
        $prefix = 'SessionId.';
        if (substr($sessionId, 0, strlen($prefix)) == $prefix) {
            return substr($sessionId, strlen($prefix));
        } else {
            return $sessionId;
        }
    }

    /**
     * Open PHP SESSION using amazon provided sessionId, for storing data about the session.
     * Session cookie won't be sent.
     */
    public function openSession()
    {
        // disable session cookies
        ini_set('session.use_cookies', 0);
        session_id($this->parseSessionId($this->sessionId));
        return session_start();
    }

    /**
     * Returns attribute value of $default.
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getAttribute($key, $default = false)
    {
        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        } else {
            return $default;
        }
    }
}
