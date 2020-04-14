<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Card;

/**
 * Class Simple
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Simple extends AbstractCard {
	/** @var string $title */
	protected $title;

	/** @var string $content */
	protected $content;


	/**
	 * @param string $title
	 * @param string $content
	 */
	public function __construct(string $title, string $content) {
		parent::__construct();

		$this->type = 'Simple';
		$this->setTitle($title);
		$this->setContent($content);
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
	 * @return Simple
	 */
	public function setTitle(string $title): Simple {
		$this->title = $title;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getContent(): string {
		return $this->content;
	}

	/**
	 * @param string $content
	 *
	 * @return Simple
	 */
	public function setContent(string $content): Simple {
		$this->content = mb_substr($content, 0, self::MAX_CONTENT_CHARS, 'UTF-8');

		return $this;
	}

	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'type'    => $this->getType(),
			'title'   => $this->getTitle(),
			'content' => $this->getContent(),
		];
	}
}
