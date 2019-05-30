<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\GameEngine;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AbstractDirective;

/**
 * Class StopInputHandler
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class StopInputHandler extends AbstractDirective {
	/** @var string $originatingRequestId */
	protected $originatingRequestId;


	/**
	 * @param string $originatingRequestId
	 */
	public function __construct($originatingRequestId) {
		parent::__construct();

		$this->type = 'GameEngine.StopInputHandler';
		$this->setOriginatingRequestId($originatingRequestId);
	}


	/**
	 * @return string
	 */
	public function getOriginatingRequestId() {
		return $this->originatingRequestId;
	}

	/**
	 * @param  string $originatingRequestId
	 *
	 * @return StopInputHandler
	 */
	public function setOriginatingRequestId($originatingRequestId) {
		$this->originatingRequestId = $originatingRequestId;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		$rendered = [
			'type'                 => $this->getType(),
			'originatingRequestId' => $this->getOriginatingRequestId(),
		];

		return $rendered;
	}
}
