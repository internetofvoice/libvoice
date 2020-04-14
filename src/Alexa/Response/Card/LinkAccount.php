<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Card;

/**
 * Class LinkAccount
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class LinkAccount extends AbstractCard {
	public function __construct() {
		parent::__construct();

		$this->type = 'LinkAccount';
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
