<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives;

/**
 * Class Image
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Image {
	/** @var string $contentDescription */
	protected $contentDescription;

	/** @var string $imageXSmall */
	protected $imageXSmall;

	/** @var string $imageSmall */
	protected $imageSmall;

	/** @var string $imageMedium */
	protected $imageMedium;

	/** @var string $imageLarge */
	protected $imageLarge;

	/** @var string $imageXLarge */
	protected $imageXLarge;


	/**
	 * @param string $contentDescription
	 */
	public function __construct($contentDescription) {
		$this->setContentDescription($contentDescription);
	}


	/**
	 * @return string
	 */
	public function getContentDescription() {
		return $this->contentDescription;
	}

	/**
	 * @param  string $contentDescription
	 *
	 * @return Image
	 */
	public function setContentDescription($contentDescription) {
		$this->contentDescription = $contentDescription;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getImageXSmall() {
		return $this->imageXSmall;
	}

	/**
	 * @param  string $imageXSmall  URL of X_SMALL image
	 *
	 * @return Image
	 */
	public function setImageXSmall($imageXSmall) {
		$this->imageXSmall = $imageXSmall;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getImageSmall() {
		return $this->imageSmall;
	}

	/**
	 * @param  string $imageSmall   URL of SMALL image
	 *
	 * @return Image
	 */
	public function setImageSmall($imageSmall) {
		$this->imageSmall = $imageSmall;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getImageMedium() {
		return $this->imageMedium;
	}

	/**
	 * @param  string $imageMedium  URL of MEDIUM image
	 *
	 * @return Image
	 */
	public function setImageMedium($imageMedium) {
		$this->imageMedium = $imageMedium;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getImageLarge() {
		return $this->imageLarge;
	}

	/**
	 * @param  string $imageLarge   URL of LARGE image
	 *
	 * @return Image
	 */
	public function setImageLarge($imageLarge) {
		$this->imageLarge = $imageLarge;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getImageXLarge() {
		return $this->imageXLarge;
	}

	/**
	 * @param  string $imageXLarge  URL of X_LARGE image
	 *
	 * @return Image
	 */
	public function setImageXLarge($imageXLarge) {
		$this->imageXLarge = $imageXLarge;

		return $this;
	}

	/**
	 * @return array
	 */
	public function render() {
		$result = [
			'contentDescription' => $this->getContentDescription(),
			'sources' => [],
		];

		if($this->getImageXSmall()) {
			array_push($result['sources'], ['size' => 'X_SMALL', 'url' => $this->getImageXSmall()]);
		}

		if($this->getImageSmall()) {
			array_push($result['sources'], ['size' => 'SMALL', 'url' => $this->getImageSmall()]);
		}

		if($this->getImageMedium()) {
			array_push($result['sources'], ['size' => 'MEDIUM', 'url' => $this->getImageMedium()]);
		}

		if($this->getImageLarge()) {
			array_push($result['sources'], ['size' => 'LARGE', 'url' => $this->getImageLarge()]);
		}

		if($this->getImageXLarge()) {
			array_push($result['sources'], ['size' => 'X_LARGE', 'url' => $this->getImageXLarge()]);
		}

		return $result;
	}
}
