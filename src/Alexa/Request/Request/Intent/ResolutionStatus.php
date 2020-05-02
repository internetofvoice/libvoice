<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\Intent;

use \InvalidArgumentException;

/**
 * Class ResolutionStatus
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ResolutionStatus {
	const VALID_CODES = ['ER_SUCCESS_MATCH', 'ER_SUCCESS_NO_MATCH', 'ER_ERROR_TIMEOUT', 'ER_ERROR_EXCEPTION'];

	/** @var string $code */
	protected $code;


	/**
	 * @param array $data
	 */
	public function __construct(array $data = []) {
		if(isset($data['code'])) {
			$this->code = $data['code'];
		}
	}


	/**
	 * @return string
	 */
	public function getCode(): string  {
		return $this->code;
	}

	/**
	 * @param  string $code
	 *
	 * @return ResolutionStatus
	 * @throws InvalidArgumentException
	 */
	public function setCode(string $code): ResolutionStatus {
		if(!in_array($code, self::VALID_CODES)) {
			throw new InvalidArgumentException('Code must be one of ' . implode(', ', self::VALID_CODES));
		}

		$this->code = $code;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'code' => $this->getCode(),
		];
	}
}
