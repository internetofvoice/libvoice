<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Card;

use \InvalidArgumentException;

/**
 * Class Standard
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Standard extends AbstractCard {
	/** @var string $title */
	protected $title;

	/** @var string $text */
	protected $text;

	/** @var string $smallImageUrl */
	protected $smallImageUrl;

	/** @var string $largeImageUrl */
	protected $largeImageUrl;


	/**
	 * @param string $title
	 * @param string $text
	 * @param string $smallImageUrl
	 * @param string $largeImageUrl
	 */
	public function __construct(string $title, string $text, string $smallImageUrl, string $largeImageUrl) {
		parent::__construct();

		$this->type = 'Standard';
		$this->setTitle($title);
		$this->setText($text);
		$this->setSmallImageUrl($smallImageUrl);
		$this->setLargeImageUrl($largeImageUrl);
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
	 * @return Standard
	 */
	public function setTitle(string $title): Standard {
		$this->title = $title;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getText(): string {
		return $this->text;
	}

	/**
	 * @param string $text
	 *
	 * @return Standard
	 */
	public function setText(string $text): Standard {
		$this->text = mb_substr($text, 0, self::MAX_CONTENT_CHARS, 'UTF-8');

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSmallImageUrl(): string {
		return $this->smallImageUrl;
	}

	/**
	 * PNG or JPG, recommended size: 720 x 480
	 *
	 * @param string $smallImageUrl
	 *
	 * @return Standard
	 *
	 * @throws InvalidArgumentException
	 */
	public function setSmallImageUrl(string $smallImageUrl): Standard {
		if (strlen($smallImageUrl) > self::MAX_URL_CHARS) {
			throw new InvalidArgumentException('Small image URL exceeds ' . self::MAX_URL_CHARS . ' characters.');
		}

		$this->smallImageUrl = $smallImageUrl;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLargeImageUrl(): string {
		return $this->largeImageUrl;
	}

	/**
	 * PNG or JPG, recommended size: 1200 x 800
	 *
	 * @param string $largeImageUrl
	 *
	 * @return Standard
	 *
	 * @throws InvalidArgumentException
	 */
	public function setLargeImageUrl(string $largeImageUrl): Standard {
		if (strlen($largeImageUrl) > self::MAX_URL_CHARS) {
			throw new InvalidArgumentException('Large image URL exceeds ' . self::MAX_URL_CHARS . ' characters.');
		}

		$this->largeImageUrl = $largeImageUrl;

		return $this;
	}

	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'type'          => $this->getType(),
			'title'         => $this->getTitle(),
			'text'          => $this->getText(),
			'smallImageUrl' => $this->getSmallImageUrl(),
			'largeImageUrl' => $this->getLargeImageUrl(),
		];
	}
}
