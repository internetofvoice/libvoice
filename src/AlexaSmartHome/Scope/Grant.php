<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Scope;

/**
 * Class Grant
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Grant {
	/** @var string $type */
	protected $type;

	/** @var string $code */
	protected $code;


	/**
	 * @param array $grantData
	 */
	public function __construct($grantData) {
		if(isset($grantData['type'])) {
			$this->type = $grantData['type'];
		}

		if(isset($grantData['code'])) {
			$this->code = $grantData['code'];
		}
	}


	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getCode() {
		return $this->code;
	}


	/**
	 * @return  array
	 */
	function render() {
		$rendered = [];
		if(!is_null($this->getType())) {
			$rendered['type'] = $this->getType();
		}

		if(!is_null($this->getCode())) {
			$rendered['code'] = $this->getCode();
		}

		return $rendered;
	}
}
