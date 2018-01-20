<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Context;

/**
 * Class Display
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Display {
	/** @var string $templateVersion */
	protected $templateVersion;

	/** @var string $markupVersion */
	protected $markupVersion;

	/** @var string $token */
	protected $token;


	/**
	 * @param array $displayData
	 */
	public function __construct($displayData) {
		if(isset($displayData['templateVersion'])) {
			$this->templateVersion = $displayData['templateVersion'];
		}

		if(isset($displayData['markupVersion'])) {
			$this->markupVersion = $displayData['markupVersion'];
		}

		if(isset($displayData['token'])) {
			$this->token = $displayData['token'];
		}
	}


	/**
	 * @return string
	 */
	public function getTemplateVersion() {
		return $this->templateVersion;
	}

	/**
	 * @return string
	 */
	public function getMarkupVersion() {
		return $this->markupVersion;
	}

	/**
	 * @return string
	 */
	public function getToken() {
		return $this->token;
	}
}
