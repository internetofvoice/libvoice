<?php

namespace Tests\Alexa\Response\Directives\Display;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Display\BodyTemplate7;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Image;
use \PHPUnit\Framework\TestCase;


/**
 * Class BodyTemplate7Test
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class BodyTemplate7Test extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testBodyTemplate7() {
		$entity = new BodyTemplate7('myToken', 'myTitle', new Image('https://picsum.photos/800/600'));
		$entity->setBackgroundImage(new Image('https://picsum.photos/720/480'));

		$expect = [
			'type'            => 'BodyTemplate7',
			'token'           => 'myToken',
			'backButton'      => 'VISIBLE',
			'title'           => 'myTitle',
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
