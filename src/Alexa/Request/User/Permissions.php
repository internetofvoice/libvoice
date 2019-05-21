<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\User;

/**
 * Class User
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Permissions {
	/** @var string $consentToken */
	protected $consentToken;


	/**
	 * @param array $permissionsData
	 */
	public function __construct($permissionsData) {
		if(isset($permissionsData['consentToken'])) {
			$this->consentToken = $permissionsData['consentToken'];
		}
	}


	/**
	 * @return string
	 */
	public function getConsentToken() {
		return $this->consentToken;
	}
}
