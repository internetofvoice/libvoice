<?php

namespace Tests\Alexa\Response\Directives;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\TextField;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;


/**
 * Class TextFieldTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class TextFieldTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testTextField() {
		$entity = new TextField('MyText', 'RichText');

		$expect = [
			'type' => 'RichText',
			'text' => 'MyText',
		];

		$this->assertEquals($expect, $entity->render());

		$this->expectException(InvalidArgumentException::class);
		$entity->setType('NON-EXISTENT-TYPE');
	}
}
