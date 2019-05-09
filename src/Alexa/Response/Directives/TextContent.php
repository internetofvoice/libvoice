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
	 * @param string $text2
	 * @param string $type2
	 * @param string $text3
	 * @param string $type3
	 */
	public function __construct($text1 = '', $type1 = null, $text2 = null, $type2 = null, $text3 = null, $type3 = null) {
		$this->setPrimaryText(new TextField($text1, $type1));

		if($text2) {
			$this->setSecondaryText(new TextField($text2, $type2));
		}

		if($text3) {
			$this->setTertiaryText(new TextField($text3, $type3));
		}
	}


	/**
	 * @return TextField
	 */
	public function getPrimaryText() {
		return $this->primaryText;
	}

	/**
	 * @param  TextField $primaryText
	 *
	 * @return TextContent
	 */
	public function setPrimaryText($primaryText) {
		$this->primaryText = $primaryText;

		return $this;
	}

	/**
	 * @return TextField
	 */
	public function getSecondaryText() {
		return $this->secondaryText;
	}

	/**
	 * @param  TextField $secondaryText
	 *
	 * @return TextContent
	 */
	public function setSecondaryText($secondaryText) {
		$this->secondaryText = $secondaryText;

		return $this;
	}

	/**
	 * @return TextField
	 */
	public function getTertiaryText() {
		return $this->tertiaryText;
	}

	/**
	 * @param  TextField $tertiaryText
	 *
	 * @return TextContent
	 */
	public function setTertiaryText($tertiaryText) {
		$this->tertiaryText = $tertiaryText;

		return $this;
	}

	/**
	 * @return array
	 */
	public function render() {
		$result = [
			'primaryText'   => $this->getPrimaryText()->render(),
			'secondaryText' => $this->getSecondaryText()->render(),
			'tertiaryText'  => $this->getTertiaryText()->render(),
		];

		return $result;
	}
}
