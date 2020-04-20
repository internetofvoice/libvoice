<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Scope;

/**
 * Class Scope
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Scope {
	/** @var string $type */
	protected $type = '';

	/** @var string $token */
	protected $token = '';


	/**
	 * @param array $scopeData
	 */
	public function __construct(array $scopeData) {
		if(isset($scopeData['type'])) {
			$this->type = $scopeData['type'];
		}

		if(isset($scopeData['token'])) {
			$this->token = $scopeData['token'];
		}
	}


	/**
	 * @return string
	 */
	public function getType(): string {
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getToken(): string {
		return $this->token;
	}


	/**
	 * @return  array
	 */
	function render(): array {
		$rendered = [];
		if($this->getType()) {
			$rendered['type'] = $this->getType();
		}

		if($this->getToken()) {
			$rendered['token'] = $this->getToken();
		}

		return $rendered;
	}
}
