<?php

namespace Tests\Alexa\Response;

use \InternetOfVoice\LibVoice\Alexa\Response\AlexaResponse;
use InternetOfVoice\LibVoice\Alexa\Response\Card\AskForPermissionsConsent;
use \PHPUnit\Framework\TestCase;

/**
 * Class AlexaResponseTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class AlexaResponseTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testAlexaResponse() {
		$response = new AlexaResponse();

		$response->respond('Text-Output');
		$expect = 'InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\PlainText';
		$this->assertEquals($expect, get_class($response->getResponse()->getOutputSpeech()));

		$response->setPlayBehavior('REPLACE_ALL');
		$this->assertEquals('REPLACE_ALL', $response->getResponse()->getOutputSpeech()->getPlayBehavior());
		$expect = [
			'type' => 'PlainText',
			'text' => 'Text-Output',
			'playBehavior' => 'REPLACE_ALL'
		];
		$this->assertEquals($expect, $response->getResponse()->getOutputSpeech()->render());

		$response->respondSSML('SSML-Output');
		$expect = 'InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\SSML';
		$this->assertEquals($expect, get_class($response->getResponse()->getOutputSpeech()));

		$response->setPlayBehavior('ENQUEUE');
		$this->assertEquals('ENQUEUE', $response->getResponse()->getOutputSpeech()->getPlayBehavior());

		$response->withLinkAccount();
		$expect = 'InternetOfVoice\LibVoice\Alexa\Response\Card\LinkAccount';
		$this->assertEquals($expect, get_class($response->getResponse()->getCard()));

		$response->withSimpleCard('Title', 'Content');
		$expect = 'InternetOfVoice\LibVoice\Alexa\Response\Card\Simple';
		$this->assertEquals($expect, get_class($response->getResponse()->getCard()));

        $response->withCard('Title', 'Content');
        $expect = 'InternetOfVoice\LibVoice\Alexa\Response\Card\Simple';
        $this->assertEquals($expect, get_class($response->getResponse()->getCard()));

		$response->withAskForPermissionsConsentCard(['alexa::devices:all:geolocation:read', 'alexa::profile:name:read']);
		$expect = 'InternetOfVoice\LibVoice\Alexa\Response\Card\AskForPermissionsConsent';

		/** @var AskForPermissionsConsent $card */
		$card = $response->getResponse()->getCard();
		$this->assertEquals($expect, get_class($card));
		$this->assertEquals(['alexa::devices:all:geolocation:read', 'alexa::profile:name:read'], $card->getPermissions());

		$response->withStandardCard('Title', 'Text', 'IMG1', 'IMG2');
		$expect = 'InternetOfVoice\LibVoice\Alexa\Response\Card\Standard';
		$this->assertEquals($expect, get_class($response->getResponse()->getCard()));

		$response->reprompt('Text-Reprompt');
		$expect = 'InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\PlainText';
		$this->assertEquals($expect, get_class($response->getResponse()->getReprompt()->getOutputSpeech()));

		$response->repromptSSML('SSML-Reprompt');
		$expect = 'InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\SSML';
		$this->assertEquals($expect, get_class($response->getResponse()->getReprompt()->getOutputSpeech()));

		$response->endSession(true);
		$this->assertTrue($response->getResponse()->getShouldEndSession());

		$this->assertEquals('1.0', $response->getVersion());
		$response->setVersion('2.0');
		$this->assertEquals('2.0', $response->getVersion());

		$this->assertEquals([], $response->getSessionAttributes());
		$response->setSessionAttribute('key', 'val');
		$this->assertEquals(['key' => 'val'], $response->getSessionAttributes());
		$this->assertEquals('val', $response->getSessionAttribute('key'));
		$this->assertFalse($response->getSessionAttribute('non_existent_key'));
		$response->setSessionAttributes(['key' => 'val', 'foo' => 'bar']);
		$this->assertEquals('bar', $response->getSessionAttribute('foo'));

		$expect = [
			'version' => '2.0',
			'sessionAttributes' => [
				'key' => 'val',
				'foo' => 'bar'
			],
			'response' => [
				'outputSpeech' => [
					'type' => 'SSML',
					'ssml' => 'SSML-Output',
					'playBehavior' => 'ENQUEUE'
				],
				'card' => [
					'type' => 'Standard',
					'title' => 'Title',
					'text' => 'Text',
					'smallImageUrl' => 'IMG1',
					'largeImageUrl' => 'IMG2'
				],
				'reprompt' => [
					'outputSpeech' => [
						'type' => 'SSML',
						'ssml' => 'SSML-Reprompt'
					]
				],
				'shouldEndSession' => true
			]
		];

		$this->assertEquals($expect, $response->render());
	}
}
