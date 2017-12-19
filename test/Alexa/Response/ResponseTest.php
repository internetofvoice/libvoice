<?php

namespace Tests\Alexa\Response;

use \InternetOfVoice\LibVoice\Alexa\Response\Response;
use \InternetOfVoice\LibVoice\Alexa\Response\Reprompt;
use \InternetOfVoice\LibVoice\Alexa\Response\Card\Simple as SimpleCard;
use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AudioPlayer\Stop;
use \InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech\PlainText;
use \PHPUnit\Framework\TestCase;

/**
 * Class ResponseTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ResponseTest extends TestCase {
	/**
	 * testResponse
	 */
	public function testResponse() {
		$response = new Response();
		$response->setOutputSpeech(new PlainText('Speech'));
		$response->setCard(new SimpleCard('Title', 'Content'));
		$response->setReprompt(new Reprompt('PlainText', 'Reprompt'));
		$response->setDirectives([new Stop()]);
		$response->addDirective(new Stop());
		$response->setShouldEndSession(true);

		/** @var PlainText $outputSpeech */
		$outputSpeech = $response->getOutputSpeech();
		$this->assertEquals('Speech', $outputSpeech->getText());

		/** @var SimpleCard $card */
		$card = $response->getCard();
		$this->assertEquals('Title', $card->getTitle());

		/** @var PlainText $outputSpeech */
		$outputSpeech = $response->getReprompt()->getOutputSpeech();
		$this->assertEquals('Reprompt', $outputSpeech->getText());

		$this->assertEquals('AudioPlayer.Stop', $response->getDirectives()[0]->getType());

		$this->assertTrue($response->getShouldEndSession());

		$expect = '{"outputSpeech":{"type":"PlainText","text":"Speech"},"card":{"type":"Simple","title":"Title","content":"Content"},"reprompt":{"outputSpeech":{"type":"PlainText","text":"Reprompt"}},"directives":[{"type":"AudioPlayer.Stop"},{"type":"AudioPlayer.Stop"}],"shouldEndSession":true}';
		$this->assertEquals($expect, json_encode($response->render()));
	}
}
