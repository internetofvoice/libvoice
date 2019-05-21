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
	public function __construct($data = []) {
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
	 * @param  string $authority
	 *
	 * @return ResolutionPerAuthority
	 */
	public function setAuthority($authority) {
		$this->authority = $authority;

		return $this;
	}

	/**
	 * @return ResolutionStatus
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param  ResolutionStatus $status
	 *
	 * @return ResolutionPerAuthority
	 */
	public function setStatus($status) {
		$this->status = $status;

		return $this;
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

	/**
	 * @param  ResolutionValue[] $values
	 *
	 * @return ResolutionPerAuthority
	 */
	public function setValues($values) {
		$this->values = [];
		foreach($values as $value) {
			$this->addValue($value);
		}

		return $this;
	}

	/**
	 * @param  ResolutionValue $value
	 *
	 * @return ResolutionPerAuthority
	 */
	public function addValue($value) {
		array_push($this->values, $value);

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		$result = [
			'authority' => $this->getAuthority(),
			'status'    => $this->getStatus()->render(),
		];

		$values = $this->getValues();
		if(count($values)) {
			$result['values'] = [];
			foreach($values as $value) {
				array_push($result['values'], ['value' => $value->render()]);
			}
		}

		return $result;
	}
}
