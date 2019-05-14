<?php

namespace Tests\Alexa\Response\Directives\Display;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Display\ListTemplate2;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Image;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\ListItem;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\TextContent;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;


/**
 * Class ListTemplate2Test
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ListTemplate2Test extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testListTemplate2() {
		$listItems = [
			new ListItem('token', new TextContent()),
		];

		$entity = new ListTemplate2('myToken', 'myTitle', $listItems);
		$entity->setBackButton('HIDDEN')->setBackgroundImage(new Image('abc'))->setToken('XYZ');

		$expect = [
			'type'       => 'ListTemplate2',
			'token'      => 'XYZ',
			'backButton' => 'HIDDEN',
			'title'      => 'myTitle',
			'backgroundImage' => [
				'contentDescription' => 'abc',
				'sources'            => [],
			],
			'listItems'  => [
				[
					'token' => 'token',
					'textContent' => [
						'primaryText' => [
							'type' => 'PlainText',
							'text' => '',
						],
					],
				],
			],
		];

		$this->assertEquals($expect, $entity->render());

		$this->expectException(InvalidArgumentException::class);
		$entity->setBackButton('NON-EXISTENT-VALUE');
	}
}
