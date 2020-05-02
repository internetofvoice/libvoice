<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives;

use \InvalidArgumentException;

/**
 * Class TextField
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class TextField {
	/** @var array VALID_TYPES */
	const VALID_TYPES = ['PlainText', 'RichText'];

	/** @var int TEXT_LENGTH */
	const TEXT_LENGTH = 8000;

	/** @var string $type */
	protected $type = 'PlainText';

	/** @var string $text */
	protected $text;


	/**
	 * @param string $text
	 * @param string $type
	 */
	public function __construct(string $text, string $type = 'PlainText') {
		$this->setText($text);
		$this->setType($type ?: 'PlainText');
	}


	/**
	 * @return string
	 */
	public function getType(): string {
		return $this->type;
	}

	/**
	 * @param  string $type
	 *
	 * @return TextField
	 */
	public function setType(string $type): TextField {
		if(!in_array($type, self::VALID_TYPES)) {
			throw new InvalidArgumentException('Type must be one of ' . implode(', ', self::VALID_TYPES));
		}

		$this->type = $type;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getText(): string {
		return $this->text;
	}

	/**
	 * @param  string $text
	 *
	 * @return TextField
	 */
	public function setText(string $text): TextField {
		$this->text = mb_substr($text, 0, self::TEXT_LENGTH, 'UTF-8');

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		return [
			'type' => $this->getType(),
			'text' => $this->getText(),
		];
	}
}
