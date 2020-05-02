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
	public function __construct(string $originatingRequestId) {
		parent::__construct();

		$this->type = 'GameEngine.StopInputHandler';
		$this->setOriginatingRequestId($originatingRequestId);
	}


	/**
	 * @return string
	 */
	public function getOriginatingRequestId(): string {
		return $this->originatingRequestId;
	}

	/**
	 * @param  string $originatingRequestId
	 *
	 * @return StopInputHandler
	 */
	public function setOriginatingRequestId(string $originatingRequestId): StopInputHandler {
		$this->originatingRequestId = $originatingRequestId;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'type'                 => $this->getType(),
			'originatingRequestId' => $this->getOriginatingRequestId(),
		];
	}
}
