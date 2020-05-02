<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives;

/**
 * Class TextContent
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class TextContent {
	/** @var TextField $primaryText */
	protected $primaryText;

	/** @var TextField $secondaryText */
	protected $secondaryText;

	/** @var TextField $tertiaryText */
	protected $tertiaryText;


	/**
	 * @param string $text1
	 * @param string $type1
	 */
	public function __construct(string $text1 = '', string $type1 = 'PlainText') {
		$this->setPrimaryText(new TextField($text1, $type1));
	}


	/**
	 * @return TextField
	 */
	public function getPrimaryText(): TextField {
		return $this->primaryText;
	}

	/**
	 * @param  TextField $primaryText
	 *
	 * @return TextContent
	 */
	public function setPrimaryText(TextField $primaryText): TextContent {
		$this->primaryText = $primaryText;

		return $this;
	}

	/**
	 * @return null|TextField
	 */
	public function getSecondaryText(): ?TextField {
		return $this->secondaryText;
	}

	/**
	 * @param  TextField $secondaryText
	 *
	 * @return TextContent
	 */
	public function setSecondaryText(TextField $secondaryText): TextContent {
		$this->secondaryText = $secondaryText;

		return $this;
	}

	/**
	 * @return null|TextField
	 */
	public function getTertiaryText(): ?TextField {
		return $this->tertiaryText;
	}

	/**
	 * @param  TextField $tertiaryText
	 *
	 * @return TextContent
	 */
	public function setTertiaryText(TextField $tertiaryText): TextContent {
		$this->tertiaryText = $tertiaryText;

		return $this;
	}

	/**
	 * @return array
	 */
	public function render(): array {
		$result = [
			'primaryText' => $this->getPrimaryText()->render(),
		];

		if($secondaryText = $this->getSecondaryText()) {
			$result['secondaryText'] = $secondaryText->render();
		}

		if($tertiaryText = $this->getTertiaryText()) {
			$result['tertiaryText'] = $tertiaryText->render();
		}

		return $result;
	}
}
