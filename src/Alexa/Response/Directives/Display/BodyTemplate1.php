<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\Display;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\TextContent;

/**
 * Class BodyTemplate1
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class BodyTemplate1 extends AbstractTemplate {
	/** @var string $title */
	protected $title;

	/** @var TextContent $textContent */
	protected $textContent;


	/**
	 * @param string      $token
	 * @param string      $title
	 * @param TextContent $textContent
	 */
	public function __construct(string $token, string $title, TextContent $textContent) {
		parent::__construct($token);

		$this->type = 'BodyTemplate1';

		$this->setTitle($title);
		$this->setTextContent($textContent);
	}


	/**
	 * @return string
	 */
	public function getTitle(): string {
		return $this->title;
	}

	/**
	 * @param  string $title
	 *
	 * @return BodyTemplate1
	 */
	public function setTitle(string $title): BodyTemplate1 {
		$this->title = $title;

		return $this;
	}

	/**
	 * @return TextContent
	 */
	public function getTextContent(): TextContent {
		return $this->textContent;
	}

	/**
	 * @param  TextContent $textContent
	 *
	 * @return BodyTemplate1
	 */
	public function setTextContent(TextContent $textContent): BodyTemplate1 {
		$this->textContent = $textContent;

		return $this;
	}


	/**
	 * @return array
	 */
	function render(): array {
		$result = [
			'type'            => $this->getType(),
			'token'           => $this->getToken(),
			'backButton'      => $this->getBackButton(),
			'title'           => $this->getTitle(),
			'textContent'     => $this->getTextContent()->render(),
		];

		if($backgroundImage = $this->getBackgroundImage()) {
			$result['backgroundImage'] = $this->getBackgroundImage()->render();
		}

		return $result;
	}
}
