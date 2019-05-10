<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\Display;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AbstractDirective;

/**
 * Class RenderTemplate
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class RenderTemplate extends AbstractDirective {
	/** @var AbstractTemplate $template */
	protected $template;


	/**
	 */
	public function __construct() {
		parent::__construct();

		$this->type = 'Display.RenderTemplate';
	}


	/**
	 * @return AbstractTemplate
	 */
	public function getTemplate() {
		return $this->template;
	}

	/**
	 * @param  AbstractTemplate $template
	 *
	 * @return RenderTemplate
	 */
	public function setTemplate($template) {
		$this->template = $template;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		$result = [
			'type'     => $this->getType(),
			'template' => $this->getTemplate()->render(),
		];

		return $result;
	}
}
