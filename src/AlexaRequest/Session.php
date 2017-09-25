<?php

namespace InternetOfVoice\LibVoice\AlexaRequest;

class Session {
	/** @var bool $new */
	protected $new;

	/** @var string $sessionId */
	protected $sessionId;

	/** @var array $attributes */
	protected $attributes;

	/** @var Application $application */
	protected $application;

	/** @var User $user */
	protected $user;


	/**
	 * @param   array $sessionData
	 */
	public function __construct($sessionData) {
		$this->new = boolval($sessionData['new']);
		$this->sessionId = $sessionData['sessionId'];
        $this->attributes = isset($sessionData['attributes']) ? $sessionData['attributes'] : [];
		$this->application = new Application($sessionData['application']);
		$this->user = new User($sessionData['user']);
	}


	/**
	 * @return bool
	 */
	public function isNew() {
		return $this->new;
	}

	/**
	 * @return string
	 */
	public function getSessionId() {
		return $this->sessionId;
	}

	/**
	 * @return array
	 */
	public function getAttributes() {
		return $this->attributes;
	}

	/**
	 * @param   string $key
	 * @param   mixed  $default
	 *
	 * @return  mixed
	 */
	public function getAttribute($key, $default = false) {
		if (isset($this->attributes[$key])) {
			return $this->attributes[$key];
		}

		return $default;
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
}
