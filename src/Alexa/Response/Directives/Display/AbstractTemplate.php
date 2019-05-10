<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\Display;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Image;
use \InvalidArgumentException;

/**
 * Abstract Class AbstractTemplate
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
abstract class AbstractTemplate {
	const VALID_BACK_BUTTON_VALUES = ['VISIBLE', 'HIDDEN'];

	/** @var string $type */
	protected $type;

	/** @var string $token */
	protected $token;

	/** @var string $backButton */
	protected $backButton = 'VISIBLE';

	/** @var Image $backgroundImage */
	protected $backgroundImage;


	/**
	 * @param string $token
	 */
	public function __construct($token) {
		$this->token = $token;
	}


	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @return string
	 */
	public function getToken() {
		return $this->token;
	}

	/**
	 * @param  string $token
	 *
	 * @return AbstractTemplate
	 */
	public function setToken($token) {
		$this->token = $token;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getBackButton() {
		return $this->backButton;
	}

	/**
	 * @param  string $backButton
	 *
	 * @return AbstractTemplate
	 * @throws InvalidArgumentException
	 */
	public function setBackButton($backButton) {
		if(!in_array($backButton, self::VALID_BACK_BUTTON_VALUES)) {
			throw new InvalidArgumentException('BackButton must be one of ' . implode(', ', self::VALID_BACK_BUTTON_VALUES));
		}

		$this->backButton = $backButton;

		return $this;
	}

	/**
	 * @return Image
	 */
	public function getBackgroundImage() {
		return $this->backgroundImage;
	}

	/**
	 * @param  Image $backgroundImage
	 *
	 * @return AbstractTemplate
	 */
	public function setBackgroundImage($backgroundImage) {
		$this->backgroundImage = $backgroundImage;

		return $this;
	}


	/**
	 * @return array
	 */
	abstract function render();
}
