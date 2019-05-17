<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\GameEngine;

/**
 * Abstract Class AbstractRecognizer
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
abstract class AbstractRecognizer {
	/** @var string $type */
	protected $type;

	/** @var string $id */
	protected $id;


	/**
	 * @param string $id
	 */
	public function __construct($id) {
		$this->setId($id);
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
	 * @return AbstractRecognizer
	 */
	public function setId($id) {
		$this->id = $id;

		return $this;
	}


	/**
	 * @return string
	 */
	public function getType(){
		return $this->type;
	}


	/**
	 * @return array
	 */
	abstract function render();
}
