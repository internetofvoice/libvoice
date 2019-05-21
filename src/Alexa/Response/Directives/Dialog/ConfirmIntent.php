<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\Dialog;

/**
 * Class ConfirmIntent
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ConfirmIntent extends AbstractDialog {
	/**
	 * @param $updatedIntent
	 */
	public function __construct($updatedIntent) {
		parent::__construct($updatedIntent);

		$this->type = 'Dialog.ConfirmIntent';
	}
}
