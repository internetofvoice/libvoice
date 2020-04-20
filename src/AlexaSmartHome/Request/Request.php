<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Request;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Request\Request\Directive;
use \InvalidArgumentException;

/**
 * Class Request
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Request {
	/** @var Directive $directive */
	protected $directive;


	/**
	 * @param  array $requestData
	 *
	 * @throws InvalidArgumentException
	 */
	public function __construct(array $requestData) {
		if(!isset($requestData['directive'])) {
			throw new InvalidArgumentException('Missing directive data.');
		}

		$this->directive = new Directive($requestData['directive']);
	}


	/**
	 * @return Directive
	 */
	public function getDirective(): Directive {
		return $this->directive;
	}
}
