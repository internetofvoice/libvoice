<?php

namespace Tests\Alexa\Response\Card;

use \InvalidArgumentException;
use \InternetOfVoice\LibVoice\Alexa\Response\Card\LinkAccount;
use \InternetOfVoice\LibVoice\Alexa\Response\Card\Simple as SimpleCard;
use \InternetOfVoice\LibVoice\Alexa\Response\Card\Standard as StandardCard;
use \PHPUnit\Framework\TestCase;

/**
 * Class CardTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class CardTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testLinkAccount() {
		$card = new LinkAccount();
		$this->assertEquals('LinkAccount', $card->getType());
		$this->assertTrue(is_array($card->render()));
		$this->assertEquals('{"type":"LinkAccount"}', json_encode($card->render()));
	}

	/**
	 * @group custom-skill
	 */
	public function testSimpleCard() {
		$card = new SimpleCard('Title', 'Content');
		$this->assertEquals('Simple', $card->getType());
		$this->assertEquals('Title', $card->getTitle());
		$this->assertEquals('Content', $card->getContent());
		$this->assertTrue(is_array($card->render()));
		$this->assertEquals('{"type":"Simple","title":"Title","content":"Content"}', json_encode($card->render()));

		$card = new SimpleCard('Title', str_repeat('x', 10000));
		$this->assertEquals(8000, strlen($card->getContent()));
	}

	/**
	 * @group custom-skill
	 */
	public function testStandardCard() {
		$card = new StandardCard('Title', 'Text', 'link1', 'link2');
		$this->assertEquals('Standard', $card->getType());
		$this->assertEquals('Title', $card->getTitle());
		$this->assertEquals('Text', $card->getText());
		$this->assertEquals('link1', $card->getSmallImageUrl());
		$this->assertEquals('link2', $card->getLargeImageUrl());
		$this->assertTrue(is_array($card->render()));
		$expect = '{"type":"Standard","title":"Title","text":"Text","smallImageUrl":"link1","largeImageUrl":"link2"}';
		$this->assertEquals($expect, json_encode($card->render()));

		$long = str_repeat('x', 10000);
		$card = new StandardCard('Title', $long, 'link1', 'link2');
		$this->assertEquals(8000, strlen($card->getText()));

		$this->expectException(InvalidArgumentException::class);
		$card->setSmallImageUrl($long);

		$this->expectException(InvalidArgumentException::class);
		$card->setLargeImageUrl($long);
	}

	/**
	 * @group custom-skill
	 */
	public function testStandardCardException() {
		$long = str_repeat('x', 10000);
		$card = new StandardCard('Title', $long, 'link1', 'link2');
		$this->expectException(InvalidArgumentException::class);
		$card->setLargeImageUrl($long);
	}
}
