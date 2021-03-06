<?php

namespace Tests\Alexa\Response\Directives;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Image;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\ListItem;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\TextContent;
use \PHPUnit\Framework\TestCase;


/**
 * Class ListItemTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ListItemTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testListItem() {
		$entity = new ListItem('myToken', new TextContent('myText1'), new Image('myContentDescription'));

		$expect = [
			'token'       => 'myToken',
			'textContent' => [
				'primaryText' =>
					[
						'type' => 'PlainText',
						'text' => 'myText1',
					],
			],
			'image'       => [
				'contentDescription' => 'myContentDescription',
				'sources'            => [],
			],
		];

		$this->assertEquals($expect, $entity->render());
	}
}
