<?php

namespace Tests\Alexa\Response\Directives\VideoApp;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\VideoApp\Launch;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\VideoApp\Metadata;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\VideoApp\VideoItem;
use \PHPUnit\Framework\TestCase;

/**
 * Class VideoAppTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class VideoAppTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testMetadata() {
		$metadata = new Metadata('Title', 'Subtitle');
		$expect = [
			'title'    => 'Title',
			'subtitle' => 'Subtitle',
		];

		$this->assertEquals($expect, $metadata->render());
	}

	/**
	 * @group custom-skill
	 */
	public function testVideoItem() {
		$videoItem = new VideoItem('https://example.com');
		$expect = [
			'source' => 'https://example.com',
		];

		$this->assertEquals($expect, $videoItem->render());
	}

	/**
	 * @group custom-skill
	 */
	public function testLaunch() {
		$metadata = new Metadata('Title', 'Subtitle');
		$launch = new Launch(new VideoItem('https://example.com', $metadata));
		$expect = [
			'type' => 'VideoApp.Launch',
			'videoItem' => [
				'source'   => 'https://example.com',
				'metadata' => [
					'title'    => 'Title',
					'subtitle' => 'Subtitle',
				]
			]
		];

		$this->assertEquals($expect, $launch->render());
	}
}
