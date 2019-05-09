<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives;

/**
 * Class ListItem
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ListItem {
	/** @var string $token */
	protected $token;

	/** @var Image $image */
	protected $image;

	/** @var TextContent $textContent */
	protected $textContent;


	/**
	 * @param string      $token
	 * @param TextContent $textContent
	 * @param Image       $image
	 */
	public function __construct($token, $textContent, $image = null) {
		$this->setToken($token);
		$this->setTextContent($textContent);
		$this->setImage($image);
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
	 * @return ListItem
	 */
	public function setToken($token) {
		$this->token = $token;

		return $this;
	}

	/**
	 * @return Image
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * @param  Image $image
	 *
	 * @return ListItem
	 */
	public function setImage($image) {
		$this->image = $image;

		return $this;
	}

	/**
	 * @return TextContent
	 */
	public function getTextContent() {
		return $this->textContent;
	}

	/**
	 * @param  TextContent $textContent
	 *
	 * @return ListItem
	 */
	public function setTextContent($textContent) {
		$this->textContent = $textContent;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		$result = [
			'token'       => $this->getToken(),
			'textContent' => $this->getTextContent()->render(),
		];

		if($this->getImage()) {
			$result['image'] = $this->getImage()->render();
		}

		return $result;
	}
}
