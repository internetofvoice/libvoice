<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech;

/**
 * Class PlainText
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class PlainText extends AbstractOutputSpeech {
	/** @var string $text */
	protected $text;


	/**
	 * @param string $text
	 */
	public function __construct($text) {
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
		$this->text = mb_substr($text, 0, self::MAX_CONTENT_CHARS, 'UTF-8');

		return $this;
	}

	/**
	 * @return array
	 */
	function render() {
		$result = [
			'type' => $this->getType(),
			'text' => $this->getText(),
		];

		if($playBehavior = $this->getPlayBehavior()) {
			$result['playBehavior'] = $playBehavior;
		}

		return $result;
	}
}
