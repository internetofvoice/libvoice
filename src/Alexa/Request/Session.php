<?php

namespace InternetOfVoice\LibVoice\Alexa\Request;

/**
 * Class Session
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
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
	public function __construct(array $sessionData) {
		$this->new         = boolval($sessionData['new']);
		$this->sessionId   = $sessionData['sessionId'];
		$this->attributes  = isset($sessionData['attributes']) ? $sessionData['attributes'] : [];
		$this->application = new Application($sessionData['application']);
		$this->user        = new User($sessionData['user']);
	}


	/**
	 * @return bool
	 */
	public function isNew(): bool {
		return $this->new;
	}

	/**
	 * @return string
	 */
	public function getSessionId(): string {
		return $this->sessionId;
	}

	/**
	 * @return array
	 */
	public function getAttributes(): array {
		return $this->attributes;
	}

	/**
	 * @param   string $key
	 * @param   mixed  $default
	 *
	 * @return  mixed
	 */
	public function getAttribute(string $key, $default = false) {
		if (isset($this->attributes[$key])) {
			return $this->attributes[$key];
		}

		return $default;
	}

	/**
	 * @return Application
	 */
	public function getApplication(): Application {
		return $this->application;
	}

	/**
	 * @return User
	 */
	public function getUser(): User {
		return $this->user;
	}
}
