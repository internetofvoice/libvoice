<?php

namespace Alexa\Request;

class User {
	/** @var string $userId */
	protected $userId;

	/** @var string $accessToken */
	protected $accessToken;

	/** @var array $permissions */
	protected $permissions;


	/**
	 * @param   array $userData
	 */
	public function __construct($userData) {
		$this->userId = $userData['userId'];

		if(isset($userData['accessToken'])) {
			$this->accessToken = $userData['accessToken'];
		}

		if(isset($userData['permissions']) && is_array($userData['permissions'])) {
			$this->permissions = $userData['permissions'];
		}
	}


	/**
	 * @return string
	 */
	public function getUserId() {
		return $this->userId;
	}

	/**
	 * @return string
	 */
	public function getAccessToken() {
		return $this->accessToken;
	}

	/**
	 * @return array
	 */
	public function getPermissions() {
		return $this->permissions;
	}
}
