<?php

namespace Tests\Alexa\Response\Directives;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\ImageVariant;
use \PHPUnit\Framework\TestCase;

/**
 * Class ImageVariantTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ImageVariantTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testImageVariant() {
		$imageVariant = new ImageVariant('http://my.image.url', 'X_SMALL', 256, 128);

		$expect = [
			'url' => 'http://my.image.url',
			'size' => 'X_SMALL',
			'widthPixels' => 256,
			'heightPixels' => 128,
		];

		$this->assertEquals($expect, $imageVariant->render());

		$expect = [
			'url' => 'http://my.image.url',
			'size' => 'X_SMALL',
			'widthPixels' => 256,
			'heightPixels' => 128,
		];

		$this->assertEquals($expect, $imageVariant->render());
	}

	public function testInvalidSize() {
		$this->expectException('InvalidArgumentException');
		new ImageVariant('http://my.image.url', 'NON_EXISTENT_SIZE');
	}
}
