<?php

namespace Tests\Alexa\Response\Directives;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Hint;
use \PHPUnit\Framework\TestCase;


/**
 * Class HintTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class HintTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testHint() {
		$entity = new Hint('MyHint');

		$expect = [
			'type' => 'Hint',
			'hint' => [
				'type' => 'PlainText',
				'text' => 'MyHint',
			],
		];

		$this->assertEquals($expect, $entity->render());
	}
}
