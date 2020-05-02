<?php

namespace Tests\Alexa\Response\Directives;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Image;
use \PHPUnit\Framework\TestCase;

/**
 * Class ImageTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ImageTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testImage() {
		$image = new Image('https://picsum.photos/1920/1280');
		$image->setContentDescription('My descriptive text');

		$expect = [
			'sources' => [
				[
					'url' => 'https://picsum.photos/1920/1280',
				],
			],
			'contentDescription' => 'My descriptive text',
		];

		$this->assertEquals($expect, $image->render());
		$this->assertNull($image->getImage('X_SMALL'));

		$image->setImage('https://picsum.photos/720/480', 'SMALL', 720, 480);
		$image->setImage('https://picsum.photos/1024/768', 'MEDIUM', 1024, 768);
		$image->setContentDescription('My description');

		$expect = [
			'sources' => [
				[
					'url'          => 'https://picsum.photos/720/480',
					'size'         => 'SMALL',
					'widthPixels'  => 720,
					'heightPixels' => 480,

				],
				[
					'url'          => 'https://picsum.photos/1024/768',
					'size'         => 'MEDIUM',
					'widthPixels'  => 1024,
					'heightPixels' => 768,

				],
			],
			'contentDescription' => 'My description',
		];

		$this->assertEquals($expect, $image->render());
	}
}
