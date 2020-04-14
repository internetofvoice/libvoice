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
	 * @param string      $title
	 * @param Image       $image
	 */
	public function __construct(string $token, string $title, Image $image) {
		parent::__construct($token);

		$this->type = 'BodyTemplate7';

		$this->setTitle($title);
		$this->setImage($image);
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
	 * @return BodyTemplate7
	 */
	public function setTitle(string $title): BodyTemplate7 {
		$this->title = $title;

		return $this;
	}

	/**
	 * @return Image
	 */
	public function getImage(): Image {
		return $this->image;
	}

	/**
	 * @param  Image $image
	 *
	 * @return BodyTemplate7
	 */
	public function setImage(Image $image): BodyTemplate7 {
		$this->image = $image;

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
		];

		if($backgroundImage = $this->getBackgroundImage()) {
			$result['backgroundImage'] = $this->getBackgroundImage()->render();
		}

		return $result;
	}
}
