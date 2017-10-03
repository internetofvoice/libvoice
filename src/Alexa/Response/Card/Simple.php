<?php

namespace Alexa\Alexa\Response\Card;

/**
 * Class Simple
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Simple extends AbstractCard {
	/** @var  string $title */
	protected $title;

	/** @var  string $content */
	protected $content;


	/**
	 * @param string $title
	 * @param string $content
	 */
	public function __construct($title, $content) {
		parent::__construct();

		$this->type = 'Simple';
		$this->setTitle($title);
		$this->setContent($content);
	}


	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $title
	 *
	 * @return Simple
	 */
	public function setTitle($title) {
		$this->title = $title;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param string $content
	 *
	 * @return Simple
	 */
	public function setContent($content) {
		$this->content = mb_substr($content, 0, self::MAX_CONTENT_CHARS, 'UTF-8');

		return $this;
	}

	/**
	 * @return array
	 */
	public function render() {
		return [
			'type'    => $this->type,
			'title'   => $this->title,
			'content' => $this->content,
		];
	}
}
