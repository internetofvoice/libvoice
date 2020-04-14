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
	public function __construct(string $token, TextContent $textContent, Image $image = null) {
		$this->setToken($token);
		$this->setTextContent($textContent);

		if($image) {
			$this->setImage($image);
		}
	}


	/**
	 * @return string
	 */
	public function getToken(): string {
		return $this->token;
	}

	/**
	 * @param  string $token
	 *
	 * @return ListItem
	 */
	public function setToken(string $token): ListItem {
		$this->token = $token;

		return $this;
	}

	/**
	 * @return null|Image
	 */
	public function getImage(): ?Image {
		return $this->image;
	}

	/**
	 * @param  Image $image
	 *
	 * @return ListItem
	 */
	public function setImage(Image $image): ListItem {
		$this->image = $image;

		return $this;
	}

	/**
	 * @return TextContent
	 */
	public function getTextContent(): TextContent {
		return $this->textContent;
	}

	/**
	 * @param  TextContent $textContent
	 *
	 * @return ListItem
	 */
	public function setTextContent(TextContent $textContent): ListItem {
		$this->textContent = $textContent;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
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
