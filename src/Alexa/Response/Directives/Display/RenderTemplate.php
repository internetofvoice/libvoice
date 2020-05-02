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
	 * @param AbstractTemplate $template
	 */
	public function __construct(AbstractTemplate $template) {
		parent::__construct();

		$this->type = 'Display.RenderTemplate';
		$this->setTemplate($template);
	}


	/**
	 * @return AbstractTemplate
	 */
	public function getTemplate(): AbstractTemplate {
		return $this->template;
	}

	/**
	 * @param  AbstractTemplate $template
	 *
	 * @return RenderTemplate
	 */
	public function setTemplate(AbstractTemplate $template): RenderTemplate {
		$this->template = $template;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'type'     => $this->getType(),
			'template' => $this->getTemplate()->render(),
		];
	}
}
