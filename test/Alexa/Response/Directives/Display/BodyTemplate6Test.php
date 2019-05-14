<?php

namespace Tests\Alexa\Response\Directives\Display;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Display\BodyTemplate6;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\TextContent;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Image;
use \PHPUnit\Framework\TestCase;


/**
 * Class BodyTemplate6Test
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class BodyTemplate6Test extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testBodyTemplate6() {
		$entity = new BodyTemplate6('myToken', new Image('myImage'), new TextContent('myText1'));
		$entity->setBackgroundImage(new Image('abc'));

		$expect = [
			'type'            => 'BodyTemplate6',
			'token'           => 'myToken',
			'backButton'      => 'VISIBLE',
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
