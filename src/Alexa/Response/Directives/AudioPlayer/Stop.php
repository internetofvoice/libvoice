<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\AudioPlayer;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AbstractDirective;

/**
 * Class Stop
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Stop extends AbstractDirective {
	public function __construct() {
		parent::__construct();

		$this->type = 'AudioPlayer.Stop';
	}


	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'type' => $this->getType(),
		];
	}
}
