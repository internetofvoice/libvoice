<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\Intent;

/**
 * Class ResolutionValue
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ResolutionValue {
	/** @var string $name */
	protected $name;

	/** @var string $id */
	protected $id;


	/**
	 * @param array $data
	 */
	public function __construct($data) {
		if(isset($data['name'])) {
			$this->name = $data['name'];
		}

		if(isset($data['id'])) {
			$this->id = $data['id'];
		}
	}


	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}
}
