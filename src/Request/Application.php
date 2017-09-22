<?php

namespace Alexa\Request;

class Application {
	/** @var string $applicationId */
	protected $applicationId;


	/**
	 * @param   array $applicationData
	 */
	public function __construct($applicationData) {
		$this->applicationIdId = $applicationData['applicationId'];
	}


	/**
	 * Validate request applicationId against valid applicationId(s)
	 *
	 * @param   array $validApplicationIds
	 *
	 * @return  bool
	 */
	public function validateApplicationId($validApplicationIds) {
		return in_array($this->applicationId, $validApplicationIds);
	}


	/**
	 * @return string
	 */
	public function getApplicationId() {
		return $this->applicationId;
	}
}
