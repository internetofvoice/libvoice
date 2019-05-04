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
		$image = new Image('My descriptive text');
		$image->setImageXSmall('https://picsum.photos/480/320');
		$image->setImageSmall('https://picsum.photos/720/480');
		$image->setImageMedium('https://picsum.photos/960/640');
		$image->setImageLarge('https://picsum.photos/1200/800');
		$image->setImageXLarge('https://picsum.photos/1920/1280');

		$expect = [
			'contentDescription' => 'My descriptive text',
			'sources' => [
				[
					'size' => 'X_SMALL',
					'url'  => 'https://picsum.photos/480/320',
				],
				[
					'size' => 'SMALL',
					'url'  => 'https://picsum.photos/720/480',
				],
				[
					'size' => 'MEDIUM',
					'url'  => 'https://picsum.photos/960/640',
				],
				[
					'size' => 'LARGE',
					'url'  => 'https://picsum.photos/1200/800',
				],
				[
					'size' => 'X_LARGE',
					'url'  => 'https://picsum.photos/1920/1280',
				],
			],
		];


		$this->assertEquals($expect, $image->render());
	}
}
