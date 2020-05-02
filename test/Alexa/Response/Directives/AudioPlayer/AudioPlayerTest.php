<?php

namespace Tests\Alexa\Response\Directives\AudioPlayer;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AudioPlayer\AudioItem;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AudioPlayer\ClearQueue;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AudioPlayer\Metadata;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AudioPlayer\Play;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AudioPlayer\Stop;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AudioPlayer\Stream;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Image;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class AudioPlayerTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class AudioPlayerTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testStream() {
		$stream = new Stream('https://example.com', 'token1', 1000, 'token2');
		$expect = [
			'url'                   => 'https://example.com',
			'token'                 => 'token1',
			'expectedPreviousToken' => 'token2',
			'offsetInMilliseconds'  => 1000,
		];

		$this->assertEquals($expect, $stream->render());
	}

	/**
	 * @group custom-skill
	 */
	public function testMetadata() {
		$image    = new Image('https://picsum.photos/720/480');
		$metadata = new Metadata('Title', 'Subtitle', $image, $image);

		$expect = [
			'title'    => 'Title',
			'subtitle' => 'Subtitle',

			'art' => [
				'sources' => [['url' => 'https://picsum.photos/720/480']]
			],

			'backgroundImage' => [
				'sources' => [['url' => 'https://picsum.photos/720/480']]
			],
		];

		$this->assertEquals($expect, $metadata->render());
	}

	/**
	 * @group custom-skill
	 */
	public function testAudioItem() {
		$audioItem = new AudioItem(new Stream('https://example.com', 'token1', 1000, 'token2'));
		$audioItem->setMetadata(new Metadata());
		$expect = [
			'stream' => [
				'url'                   => 'https://example.com',
				'token'                 => 'token1',
				'expectedPreviousToken' => 'token2',
				'offsetInMilliseconds'  => 1000,
			],
			'metadata' => [],
		];

		$this->assertEquals($expect, $audioItem->render());
	}

	/**
	 * @group custom-skill
	 */
	public function testPlay() {
		$audioItem = new AudioItem(new Stream('https://example.com', 'token1', 1000, 'token2'));
		$play = new Play('REPLACE_ALL', $audioItem);
		$expect = [
			'type' => 'AudioPlayer.Play',
			'playBehavior' => 'REPLACE_ALL',
			'audioItem' => [
				'stream' => [
					'url'                   => 'https://example.com',
					'token'                 => 'token1',
					'expectedPreviousToken' => 'token2',
					'offsetInMilliseconds'  => 1000,
				],
			],
		];

		$this->assertEquals($expect, $play->render());

		$this->expectException(InvalidArgumentException::class);
		$play->setPlayBehavior('NON_EXISTENT_PLAY_BEHAVIOR');
	}

	/**
	 * @group custom-skill
	 */
	public function testPlayExceptions() {
		$play = new Play('ENQUEUE', new AudioItem(new Stream('https://example.com', 'token1')));
		$this->expectException(InvalidArgumentException::class);
		$play->render();
	}

	/**
	 * @group custom-skill
	 */
	public function testStop() {
		$stop = new Stop();
		$expect = [
			'type' => 'AudioPlayer.Stop',
		];

		$this->assertEquals($expect, $stop->render());
	}

	/**
	 * @group custom-skill
	 */
	public function testClearQueue() {
		$clearQueue = new ClearQueue('CLEAR_ENQUEUED');
		$expect = [
			'type' => 'AudioPlayer.ClearQueue',
			'clearBehavior' => 'CLEAR_ENQUEUED',
		];

		$this->assertEquals($expect, $clearQueue->render());

		$this->expectException(InvalidArgumentException::class);
		$clearQueue->setClearBehavior('NON_EXISTENT_CLEAR_BEHAVIOR');
	}
}
