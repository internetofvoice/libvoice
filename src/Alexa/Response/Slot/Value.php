<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Slot;

/**
 * Class Value
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Value {
	/** @var string $id */
	protected $id;

	/** @var string $name */
	protected $name;

	/** @var array $synonyms */
	protected $synonyms = [];


	/**
	 * @param string $id
	 * @param string $name
	 */
	public function __construct($id, $name) {
		$this->setId($id);
		$this->setName($name);
	}


	/**
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param  string $id
	 *
	 * @return Value
	 */
	public function setId($id) {
		$this->id = $id;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param  string $name
	 *
	 * @return Value
	 */
	public function setName($name) {
		$this->name = $name;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getSynonyms() {
		return $this->synonyms;
	}

	/**
	 * @param  array $synonyms
	 *
	 * @return Value
	 */
	public function setSynonyms($synonyms) {
		$this->synonyms = [];
		foreach($synonyms as $synonym) {
			$this->addSynonym($synonym);
		}

		return $this;
	}

	/**
	 * @param string $synonym
	 *
	 * @return Value
	 */
	public function addSynonym($synonym) {
		array_push($this->synonyms, $synonym);

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		$result = [
			'id' => $this->getId(),
			'name' => [
				'value' => $this->getName(),
			],
		];

		$synonyms = $this->getSynonyms();
		if(count($synonyms)) {
			$result['name']['synonyms'] = $synonyms;
		}

		return $result;
	}
}
