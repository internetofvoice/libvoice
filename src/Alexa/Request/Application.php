<?php

namespace InternetOfVoice\LibVoice\Alexa\Request;

/**
 * Class Application
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Application {
	/** @var string $applicationId */
	protected $applicationId;


	/**
	 * @param array $applicationData
	 */
	public function __construct(array $applicationData) {
		$this->applicationId = $applicationData['applicationId'];
	}


	/**
	 * @param  array $validApplicationIds
	 *
	 * @return bool
	 */
	public function validateApplicationId(array $validApplicationIds): bool {
		return in_array($this->applicationId, $validApplicationIds);
	}


	/**
	 * @return string
	 */
	public function getApplicationId(): string {
		return $this->applicationId;
	}
}
