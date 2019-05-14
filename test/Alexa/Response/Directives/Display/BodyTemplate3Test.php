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
		$entity = new BodyTemplate3('myToken', 'myTitle', new Image('myImage'), new TextContent('myText1'));
		$entity->setBackgroundImage(new Image('abc'));

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
				'contentDescription' => 'abc',
				'sources'            => [],
			],
			'image' => [
				'contentDescription' => 'myImage',
				'sources'            => [],
			],
		];

		$this->assertEquals($expect, $entity->render());
	}
}
