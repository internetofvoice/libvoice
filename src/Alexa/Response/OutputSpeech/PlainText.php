<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech;


class PlainText extends OutputSpeech {
	const MAX_CONTENT_LENGTH = 6000;

	/** @var string $text */
	protected $text;


	/**
	 * @param string $text
	 */
	public function __construct($text = '') {
		parent::__construct();

		$this->type = 'PlainText';
		$this->setText($text);
	}


	/**
	 * @return string
	 */
	public function getText() {
		return $this->text;
	}

	/**
	 * @param string $text
	 *
	 * @return PlainText
	 */
	public function setText($text) {
		$this->text = mb_substr($text, 0, self::MAX_CONTENT_LENGTH, 'UTF-8');

		return $this;
	}

	/**
	 * @return array
	 */
	function render() {
		return [
			'type' => $this->type,
			'text' => $this->text,
		];
	}
}
