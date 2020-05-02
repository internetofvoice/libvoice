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
	protected $contentDescription = '';

	/** @var ImageVariant[] $images */
	protected $images = [];


	/**
	 * @param string $url
	 * @param string $size
	 * @param int    $widthPixels
	 * @param int    $heightPixels
	 * @param string $contentDescription
	 */
	public function __construct(
		string $url = '',
		string $size = '',
		int $widthPixels = 0,
		int $heightPixels = 0,
		string $contentDescription = ''
	) {
		$this->setContentDescription($contentDescription);

		if(!empty($url)) {
			$this->setImage($url, $size, $widthPixels, $heightPixels);
		}
	}


	/**
	 * @return string
	 */
	public function getContentDescription(): string {
		return $this->contentDescription;
	}

	/**
	 * @param  string $contentDescription
	 *
	 * @return Image
	 */
	public function setContentDescription(string $contentDescription): Image {
		$this->contentDescription = $contentDescription;

		return $this;
	}

	/**
	 * @param  string $url
	 * @param  string $size
	 * @param  int    $widthPixels
	 * @param  int    $heightPixels
	 *
	 * @return Image
	 */
	public function setImage(string $url, string $size = '', int $widthPixels = 0, int $heightPixels = 0): Image {
		$this->setImageVariant(new ImageVariant($url, $size, $widthPixels, $heightPixels));

		return $this;
	}

	/**
	 * @param  ImageVariant $imageVariant
	 *
	 * @return Image
	 */
	public function setImageVariant(ImageVariant $imageVariant): Image {
		$size = $imageVariant->getSize() ?? 'UNDEFINED';
		$this->images[$size] = $imageVariant;

		return $this;
	}

	/**
	 * @param  string $size
	 *
	 * @return null|ImageVariant
	 */
	public function getImage(string $size): ?ImageVariant {
		$size = $size ?? 'UNDEFINED';
		if(!array_key_exists($size, $this->images)) {
			return null;
		}

		return $this->images[$size];
	}

	/**
	 * @return ImageVariant[]
	 */
	public function getImages(): array {
		return $this->images;
	}

	/**
	 * @return array
	 */
	public function render(): array {
		$result = [
			'sources' => []
		];

		if($this->getContentDescription()) {
			$result['contentDescription'] = $this->getContentDescription();
		}

		// Take either the only one image with unspecified size, or all with a defined size
		$undefined = $this->getImage('');
		$images    = $this->getImages();

		if($undefined && count($images) === 1) {
			array_push($result['sources'], $undefined->render());
		} else {
			foreach($images as $image) {
				if(empty($image->getSize())) {
					continue;
				}

				array_push($result['sources'], $image->render());
			}
		}

		return $result;
	}
}
