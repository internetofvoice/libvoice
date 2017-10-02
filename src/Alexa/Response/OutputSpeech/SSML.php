<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech;


class SSML extends OutputSpeech {
	const MAX_CONTENT_LENGTH = 6000;

	/** @var string $ssml */
	protected $ssml;


	/**
	 * @param string $ssml
	 */
	public function __construct($ssml = '') {
		parent::__construct();

		$this->type = 'SSML';
		$this->setSSML($ssml);
	}


	/**
	 * @return string
	 */
	public function getSSML() {
		return $this->ssml;
	}

	/**
	 * @param string $ssml
	 *
	 * @return SSML
	 */
	public function setSSML($ssml) {
		$this->ssml = mb_substr($ssml, 0, self::MAX_CONTENT_LENGTH, 'UTF-8');

		return $this;
	}

	/**
	 * @return array
	 */
	function render() {
		return [
			'type' => $this->type,
			'ssml' => $this->ssml,
		];
	}
}
