<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\AudioPlayer;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Image;

/**
 * Class Metadata
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Metadata {
	/** @var string $title */
	protected $title = '';

	/** @var string $subtitle */
	protected $subtitle = '';

	/** @var Image $art */
	protected $art;

	/** @var Image $backgroundImage */
	protected $backgroundImage;


	/**
	 * @param string $title
	 * @param string $subtitle
	 * @param Image  $art
	 * @param Image  $backgroundImage
	 */
	public function __construct(string $title = '', string $subtitle = '', Image $art = null, Image $backgroundImage = null) {
		$this->setTitle($title);
		$this->setSubtitle($subtitle);

		if(!is_null($art)) {
			$this->setArt($art);
		}

		if(!is_null($backgroundImage)) {
			$this->setBackgroundImage($backgroundImage);
		}
	}


	/**
	 * @return string
	 */
	public function getTitle(): string {
		return $this->title;
	}

	/**
	 * @param string $title
	 *
	 * @return Metadata
	 */
	public function setTitle(string $title): Metadata {
		$this->title = $title;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSubtitle(): string {
		return $this->subtitle;
	}

	/**
	 * @param string $subtitle
	 *
	 * @return Metadata
	 */
	public function setSubtitle(string $subtitle): Metadata {
		$this->subtitle = $subtitle;

		return $this;
	}

	/**
	 * @return null|Image
	 */
	public function getArt(): ?Image {
		return $this->art;
	}

	/**
	 * @param  Image $art
	 *
	 * @return Metadata
	 */
	public function setArt(Image $art): Metadata {
		$this->art = $art;

		return $this;
	}

	/**
	 * @return null|Image
	 */
	public function getBackgroundImage(): ?Image {
		return $this->backgroundImage;
	}

	/**
	 * @param  Image $backgroundImage
	 *
	 * @return Metadata
	 */
	public function setBackgroundImage(Image $backgroundImage): Metadata {
		$this->backgroundImage = $backgroundImage;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		$result = [];
		if($this->getTitle()) {
			$result['title'] = $this->getTitle();
		}

		if($this->getSubtitle()) {
			$result['subtitle'] = $this->getSubtitle();
		}

		if($this->getArt()) {
			$result['art'] = $this->getArt()->render();
		}

		if($this->getBackgroundImage()) {
			$result['backgroundImage'] = $this->getBackgroundImage()->render();
		}

		return $result;
	}
}
