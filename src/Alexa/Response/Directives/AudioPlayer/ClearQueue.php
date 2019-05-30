<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\AudioPlayer;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AbstractDirective;
use \InvalidArgumentException;

/**
 * Class ClearQueue
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ClearQueue extends AbstractDirective {
	/** @var array CLEAR_BEHAVIORS */
	const CLEAR_BEHAVIORS = ['CLEAR_ENQUEUED', 'CLEAR_ALL'];

	/** @var string $clearBehavior */
	protected $clearBehavior = 'CLEAR_ALL';


	/**
	 * @param string $clearBehavior
	 */
	public function __construct($clearBehavior) {
		parent::__construct();

		$this->type = 'AudioPlayer.ClearQueue';
		$this->setClearBehavior($clearBehavior);
	}


	/**
	 * @return string
	 */
	public function getClearBehavior() {
		return $this->clearBehavior;
	}

	/**
	 * @param string $clearBehavior
	 *
	 * @return ClearQueue
	 * @throws InvalidArgumentException
	 */
	public function setClearBehavior($clearBehavior) {
		if(!in_array($clearBehavior, self::CLEAR_BEHAVIORS)) {
			throw new InvalidArgumentException('ClearBehavior must be one of ' . implode(', ', self::CLEAR_BEHAVIORS));
		}

		$this->clearBehavior = $clearBehavior;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		return [
			'type'          => $this->getType(),
			'clearBehavior' => $this->getClearBehavior(),
		];
	}
}
