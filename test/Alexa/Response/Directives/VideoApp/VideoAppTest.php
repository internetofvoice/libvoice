<?php

namespace Tests\Alexa\Response\Directives\VideoApp;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\VideoApp\Launch;
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
	public function testVideoItem() {
		$videoItem = new VideoItem('https://example.com', 'Title', 'Subtitle');
		$expect = [
			'source' => 'https://example.com',
			'metadata' => [
				'title' => 'Title',
				'subtitle' => 'Subtitle',
			]
		];

		$this->assertEquals($expect, $videoItem->render());
	}

	/**
	 * @group custom-skill
	 */
	public function testLaunch() {
		$launch = new Launch(new VideoItem('https://example.com', 'Title', 'Subtitle'));
		$expect = [
			'type' => 'VideoApp.Launch',
			'videoItem' => [
				'source' => 'https://example.com',
				'metadata' => [
					'title' => 'Title',
					'subtitle' => 'Subtitle',
				]
			]
		];

		$this->assertEquals($expect, $launch->render());
	}
}
