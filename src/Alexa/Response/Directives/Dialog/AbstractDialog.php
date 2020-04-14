<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\Dialog;

use InternetOfVoice\LibVoice\Alexa\Request\Request\Intent\Intent;
use InternetOfVoice\LibVoice\Alexa\Response\Directives\AbstractDirective;

/**
 * Abstract Class AbstractDialog
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
abstract class AbstractDialog extends AbstractDirective {
	/** @var Intent $updatedIntent */
	protected $updatedIntent;


	/**
	 * @param Intent $updatedIntent
	 */
	public function __construct(Intent $updatedIntent) {
		parent::__construct();

		$this->setUpdatedIntent($updatedIntent);
	}


	/**
	 * @return Intent
	 */
	public function getUpdatedIntent(): Intent {
		return $this->updatedIntent;
	}

	/**
	 * @param  Intent $updatedIntent
	 *
	 * @return AbstractDialog
	 */
	public function setUpdatedIntent(Intent $updatedIntent): AbstractDialog {
		$this->updatedIntent = $updatedIntent;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'type'          => $this->getType(),
			'updatedIntent' => $this->getUpdatedIntent()->render(),
		];
	}
}
