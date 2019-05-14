<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\Display;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Image;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\TextContent;

/**
 * Class BodyTemplate6
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class BodyTemplate6 extends AbstractTemplate {
	/** @var Image $image */
	protected $image;

	/** @var TextContent $textContent */
	protected $textContent;


	/**
	 * @param string      $token
	 * @param Image       $image
	 * @param TextContent $textContent
	 */
	public function __construct($token, $image, $textContent) {
		parent::__construct($token);

		$this->type = 'BodyTemplate6';

		$this->setImage($image);
		$this->setTextContent($textContent);
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
	 * @return BodyTemplate6
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
	 * @return BodyTemplate6
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
			'image'           => $this->getImage()->render(),
			'textContent'     => $this->getTextContent()->render(),
		];

		if($backgroundImage = $this->getBackgroundImage()) {
			$result['backgroundImage'] = $this->getBackgroundImage()->render();
		}

		return $result;
	}
}
