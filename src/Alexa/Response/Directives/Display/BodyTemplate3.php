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
	 * @param Image       $image
	 * @param string      $title
	 * @param TextContent $textContent
	 */
	public function __construct($token, $title, $image, $textContent) {
		parent::__construct($token, $title, $image, $textContent);
	}
}
