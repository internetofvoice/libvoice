<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\Dialog;

use InternetOfVoice\LibVoice\Alexa\Request\Request\Intent\Intent;

/**
 * Class Delegate
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Delegate extends AbstractDialog {
	/**
	 * @param Intent $updatedIntent
	 */
	public function __construct(Intent $updatedIntent) {
		parent::__construct($updatedIntent);

		$this->type = 'Dialog.Delegate';
	}
}
