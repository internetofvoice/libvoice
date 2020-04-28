<?php

namespace Tests\Alexa\Response\Directives\Display;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Display\BodyTemplate3;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\TextContent;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Image;
use \PHPUnit\Framework\TestCase;


/**
 * Class BodyTemplate3Test
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class BodyTemplate3Test extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testBodyTemplate3() {
		$entity = new BodyTemplate3('myToken', 'myTitle', new Image('https://picsum.photos/800/600'), new TextContent('myText1'));
		$entity->setBackgroundImage(new Image('https://picsum.photos/720/480'));

		$expect = [
			'type'            => 'BodyTemplate3',
			'token'           => 'myToken',
			'backButton'      => 'VISIBLE',
			'title'           => 'myTitle',
			'textContent'     => [
				'primaryText' => [
					'type' => 'PlainText',
					'text' => 'myText1',
				],
			],
			'backgroundImage' => [
				'sources' => [['url' => 'https://picsum.photos/720/480']],
			],
			'image' => [
				'sources' => [['url' => 'https://picsum.photos/800/600']],
			],
		];

		$this->assertEquals($expect, $entity->render());
	}
}
