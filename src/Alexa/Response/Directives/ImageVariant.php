<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives;

use \InvalidArgumentException;

/**
 * Class ImageVariant
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ImageVariant {
	/** @var array SIZES */
	const SIZES = ['X_SMALL', 'SMALL', 'MEDIUM', 'LARGE', 'X_LARGE'];

	/** @var string $url */
	protected $url = '';

	/** @var string $size */
	protected $size = '';

	/** @var int $widthPixels */
	protected $widthPixels = 0;

	/** @var int $heightPixels */
	protected $heightPixels = 0;

	/**
	 * @param string $url
	 * @param string $size
	 * @param int    $widthPixels
	 * @param int    $heightPixels
	 */
	public function __construct(string $url, string $size = '', int $widthPixels = 0, int $heightPixels = 0) {
		$this->setUrl($url);
		$this->setSize($size);
		$this->setWidthPixels($widthPixels);
		$this->setHeightPixels($heightPixels);
	}


	/**
	 * @return string
	 */
	public function getUrl(): string {
		return $this->url;
	}

	/**
	 * @param  string $url
	 *
	 * @return ImageVariant
	 */
	public function setUrl(string $url): ImageVariant {
		$this->url = $url;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSize(): string {
		return $this->size;
	}

	/**
	 * @param  string $size
	 *
	 * @return ImageVariant
	 * @throws InvalidArgumentException
	 */
	public function setSize(string $size): ImageVariant {
		if(!empty($size) && !in_array($size, self::SIZES)) {
			throw new InvalidArgumentException('Size must be either an empty string or one of ' . implode(', ', self::SIZES));
		}

		$this->size = $size;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getWidthPixels(): int {
		return $this->widthPixels;
	}

	/**
	 * @param  int $widthPixels
	 *
	 * @return ImageVariant
	 */
	public function setWidthPixels(int $widthPixels): ImageVariant {
		$this->widthPixels = $widthPixels;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getHeightPixels(): int {
		return $this->heightPixels;
	}

	/**
	 * @param  int $heightPixels
	 *
	 * @return ImageVariant
	 */
	public function setHeightPixels(int $heightPixels): ImageVariant {
		$this->heightPixels = $heightPixels;

		return $this;
	}

	/**
	 * @return array
	 */
	public function render(): array {
		$result = [
			'url' => $this->getUrl(),
		];

		if($this->getSize()) {
			$result['size'] = $this->getSize();
		}

		if($this->getWidthPixels() && $this->getHeightPixels()) {
			$result['widthPixels']  = $this->getWidthPixels();
			$result['heightPixels'] = $this->getHeightPixels();
		}

		return $result;
	}
}
