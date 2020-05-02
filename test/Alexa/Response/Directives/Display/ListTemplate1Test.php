<?php

namespace Tests\Alexa\Response\Directives\Display;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Display\ListTemplate1;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Image;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\ListItem;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\TextContent;
use \PHPUnit\Framework\TestCase;


/**
 * Class ListTemplate1Test
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ListTemplate1Test extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testListTemplate1() {
		$listItems = [
			new ListItem('token', new TextContent()),
		];

		$entity = new ListTemplate1('myToken', 'myTitle', $listItems);
		$entity->setBackButton('HIDDEN')->setBackgroundImage(new Image('https://picsum.photos/720/480'));

		$expect = [
			'type'       => 'ListTemplate1',
			'token'      => 'myToken',
			'backButton' => 'HIDDEN',
			'title'      => 'myTitle',
			'backgroundImage' => [
				'sources' => [['url' => 'https://picsum.photos/720/480']],
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
	}
}
