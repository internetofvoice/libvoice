<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives;

/**
 * Class Hint
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Hint extends AbstractDirective {
	/** @var TextField $hint */
	protected $hint;


	/**
	 * @param string $text
	 */
	public function __construct($text) {
		parent::__construct();

		$this->type = 'Hint';
		$this->setHint(new TextField($text, 'PlainText'));
	}


	/**
	 * @return TextField
	 */
	public function getHint() {
		return $this->hint;
	}

	/**
	 * @param  TextField $hint
	 *
	 * @return Hint
	 */
	public function setHint($hint) {
		$this->hint = $hint;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		$result = [
			'type' => $this->getType(),
			'hint' => $this->getHint()->render(),
		];

		return $result;
	}
}
