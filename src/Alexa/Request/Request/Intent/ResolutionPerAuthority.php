<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\Intent;

/**
 * Class ResolutionPerAuthority
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ResolutionPerAuthority {
	/** @var string $authority */
	protected $authority;

	/** @var ResolutionStatus $status */
	protected $status;

	/** @var ResolutionValue[] $values */
	protected $values = [];


	/**
	 * @param array $data
	 */
	public function __construct($data) {
		if(isset($data['authority'])) {
			$this->authority = $data['authority'];
		}

		if(isset($data['status'])) {
			$this->status = new ResolutionStatus($data['status']);
		}

		if(isset($data['values'])) {
			foreach($data['values'] as $value) {
				if(isset($value['value'])) {
					array_push($this->values, new ResolutionValue($value['value']));
				}
			}
		}
	}


	/**
	 * @return string
	 */
	public function getAuthority() {
		return $this->authority;
	}

	/**
	 * @return ResolutionStatus
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @return ResolutionValue[]
	 */
	public function getValues() {
		return $this->values;
	}

	/**
	 * Get ResolutionValues as condensed array [id1 => value1, id2 => value2, ...]
	 *
	 * @return array
	 */
	public function getValuesAsArray() {
		$values = [];
		foreach($this->getValues() as $value) {
			$values[$value->getId()] = $value->getName();
		}

		return $values;
	}
}
