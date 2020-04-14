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
	public function __construct(string $text) {
		parent::__construct();

		$this->type = 'Hint';
		$this->setHint(new TextField($text, 'PlainText'));
	}


	/**
	 * @return TextField
	 */
	public function getHint(): TextField {
		return $this->hint;
	}

	/**
	 * @param  TextField $hint
	 *
	 * @return Hint
	 */
	public function setHint(TextField $hint): Hint {
		$this->hint = $hint;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'type' => $this->getType(),
			'hint' => $this->getHint()->render(),
		];
	}
}
