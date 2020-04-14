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
	public function __construct(array $data = []) {
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
	public function getName(): string  {
		return $this->name;
	}

	/**
	 * @param  string $name
	 *
	 * @return ResolutionValue
	 */
	public function setName(string $name): ResolutionValue {
		$this->name = $name;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getId(): string  {
		return $this->id;
	}

	/**
	 * @param string $id
	 *
	 * @return ResolutionValue
	 */
	public function setId(string $id): ResolutionValue {
		$this->id = $id;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'name' => $this->getName(),
			'id'   => $this->getId(),
		];
	}
}
