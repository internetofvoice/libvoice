<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\Display;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\ListItem;

/**
 * Class ListTemplate2
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ListTemplate2 extends ListTemplate1 {
	/**
	 * @param string      $token
	 * @param string      $title
	 * @param ListItem[]  $listItems
	 */
	public function __construct($token, $title, $listItems = []) {
		parent::__construct($token, $title, $listItems);
	}
}
