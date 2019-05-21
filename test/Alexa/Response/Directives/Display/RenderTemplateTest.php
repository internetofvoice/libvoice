<?php

namespace Tests\Alexa\Response\Directives\Display;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Display\BodyTemplate1;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Display\RenderTemplate;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\TextContent;
use \PHPUnit\Framework\TestCase;


/**
 * Class RenderTemplateTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class RenderTemplateTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testRenderTemplate() {
		$entity = new RenderTemplate(new BodyTemplate1('myToken', 'myTitle', new TextContent('myText1')));

		$expect = [
			'type'     => 'Display.RenderTemplate',
			'template' => [
				'type'        => 'BodyTemplate1',
				'token'       => 'myToken',
				'backButton'  => 'VISIBLE',
				'title'       => 'myTitle',
				'textContent' => [
					'primaryText' => [
						'type' => 'PlainText',
						'text' => 'myText1',
					],
				],
			],
		];

		$this->assertEquals($expect, $entity->render());
	}
}
