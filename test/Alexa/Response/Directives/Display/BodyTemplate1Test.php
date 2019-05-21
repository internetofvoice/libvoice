<?php

namespace Tests\Alexa\Response\Directives\Display;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Display\BodyTemplate1;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\TextContent;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Image;
use \PHPUnit\Framework\TestCase;


/**
 * Class BodyTemplate1Test
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class BodyTemplate1Test extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testBodyTemplate1() {
		$entity = new BodyTemplate1('myToken', 'myTitle', new TextContent('myText1'));
		$entity->setBackgroundImage(new Image('abc'));

		$expect = [
			'type'            => 'BodyTemplate1',
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
		];

		$this->assertEquals($expect, $entity->render());
	}
}
