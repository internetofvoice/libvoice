<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\Display;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Image;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\TextContent;

/**
 * Class BodyTemplate3
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class BodyTemplate3 extends BodyTemplate2 {
	/**
	 * @param string      $token
	 * @param string      $title
	 * @param Image       $image
	 * @param TextContent $textContent
	 */
	public function __construct(string $token, string $title, Image $image, TextContent $textContent) {
		parent::__construct($token, $title, $image, $textContent);

		$this->type = 'BodyTemplate3';
	}
}
