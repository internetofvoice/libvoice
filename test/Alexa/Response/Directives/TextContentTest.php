<?php

namespace Tests\Alexa\Response\Directives;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\TextContent;
use \PHPUnit\Framework\TestCase;


/**
 * Class TextContentTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class TextContentTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testTextContent() {
		$entity = new TextContent('MyText1', 'RichText', 'MyText2', 'PlainText', 'MyText3', 'PlainText');

		$expect = [
			'primaryText' => [
				'type' => 'RichText',
				'text' => 'MyText1',
			],
			'secondaryText' => [
				'type' => 'PlainText',
				'text' => 'MyText2',
			],
			'tertiaryText' => [
				'type' => 'PlainText',
				'text' => 'MyText3',
			],
		];

		$this->assertEquals($expect, $entity->render());
	}
}
