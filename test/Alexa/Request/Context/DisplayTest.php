<?php

namespace Tests\Alexa\Request\Context;

use \InternetOfVoice\LibVoice\Alexa\Request\Context\Display;
use \PHPUnit\Framework\TestCase;

/**
 * Class DisplayTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class DisplayTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testDisplay() {
		$fixture = [
			'templateVersion' => '1',
		    'markupVersion' => '2',
		    'token' => 'TOKEN',
		];

		$display = new Display($fixture);
        $this->assertEquals('1', $display->getTemplateVersion());
        $this->assertEquals('2', $display->getMarkupVersion());
        $this->assertEquals('TOKEN', $display->getToken());
	}
}
