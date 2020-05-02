<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\Display;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Image;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\TextContent;

/**
 * Class BodyTemplate2
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class BodyTemplate2 extends AbstractTemplate {
	/** @var string $title */
	protected $title;

	/** @var Image $image */
	protected $image;

	/** @var TextContent $textContent */
	protected $textContent;


	/**
	 * @param string      $token
	 * @param string      $title
	 * @param Image       $image
	 * @param TextContent $textContent
	 */
	public function __construct(string $token, string $title, Image $image, TextContent $textContent) {
		parent::__construct($token);

		$this->type = 'BodyTemplate2';

		$this->setTitle($title);
		$this->setImage($image);
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
	 * @return BodyTemplate2
	 */
	public function setTitle(string $title): BodyTemplate2 {
		$this->title = $title;

		return $this;
	}

	/**
	 * @return Image
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * @param  Image $image
	 *
	 * @return BodyTemplate2
	 */
	public function setImage($image) {
		$this->image = $image;

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
	 * @return BodyTemplate2
	 */
	public function setTextContent($textContent) {
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
			'image'           => $this->getImage()->render(),
			'textContent'     => $this->getTextContent()->render(),
		];

		if($backgroundImage = $this->getBackgroundImage()) {
			$result['backgroundImage'] = $this->getBackgroundImage()->render();
		}

		return $result;
	}
}
