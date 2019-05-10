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
	 * @param Image       $image
	 * @param string      $title
	 * @param TextContent $textContent
	 */
	public function __construct($token, $title, $image, $textContent) {
		parent::__construct($token);

		$this->setTitle($title);
		$this->setImage($image);
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
	 * @return BodyTemplate2
	 */
	public function setTitle($title) {
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
	function render() {
		$result = [
			'type'            => $this->getType(),
			'token'           => $this->getToken(),
			'backButton'      => $this->getBackButton(),
			'backgroundImage' => $this->getBackgroundImage(),
			'title'           => $this->getTitle(),
			'image'           => $this->getImage(),
			'textContent'     => $this->getTextContent(),
		];

		return $result;
	}
}
