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
	public function __construct($token, $title, $textContent) {
		parent::__construct($token);

		$this->setTitle($title);
		$this->setTextContent($textContent);
	}


	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param  string $title
	 *
	 * @return BodyTemplate1
	 */
	public function setTitle($title) {
		$this->title = $title;

		return $this;
	}

	/**
	 * @return TextContent
	 */
	public function getTextContent() {
		return $this->textContent;
	}

	/**
	 * @param  TextContent $textContent
	 *
	 * @return BodyTemplate1
	 */
	public function setTextContent($textContent) {
		$this->textContent = $textContent;

		return $this;
	}


	/**
	 * @return array
	 */
	function render() {
		$result = [
			'type'            => $this->getType(),
			'token'           => $this->getToken(),
			'backButton'      => $this->getBackButton(),
			'backgroundImage' => $this->getBackgroundImage(),
			'title'           => $this->getTitle(),
			'textContent'     => $this->getTextContent(),
		];

		return $result;
	}
}
