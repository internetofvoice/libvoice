<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\Display;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Image;

/**
 * Class BodyTemplate7
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class BodyTemplate7 extends AbstractTemplate {
	/** @var string $title */
	protected $title;

	/** @var Image $image */
	protected $image;


	/**
	 * @param string      $token
	 * @param Image       $image
	 * @param string      $title
	 */
	public function __construct($token, $title, $image) {
		parent::__construct($token);

		$this->setTitle($title);
		$this->setImage($image);
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
	 * @return BodyTemplate7
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
	 * @return BodyTemplate7
	 */
	public function setImage($image) {
		$this->image = $image;

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
		];

		return $result;
	}
}
