<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech;

/**
 * Class SSML
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class SSML extends AbstractOutputSpeech {
	/** @var string $ssml */
	protected $ssml;


	/**
	 * @param string $ssml
	 */
	public function __construct($ssml) {
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
		$this->ssml = mb_substr($ssml, 0, self::MAX_CONTENT_CHARS, 'UTF-8');

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
