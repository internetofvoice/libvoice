<?php

namespace Tests\Alexa\Request;

use \InternetOfVoice\LibVoice\Alexa\Request\AlexaRequest;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\AudioPlayer\PlaybackFailed;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\AudioPlayer\PlaybackStarted;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\SessionEndedRequest;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\System\ExceptionEncountered;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class AlexaRequestTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class AlexaRequestTest extends TestCase {
	/**
	 * testIntentRequest
	 */
	public function testIntentRequest() {
		$fixtureHeader = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Header.json'), true);
		$fixtureBody   = trim(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'));
		$alexaRequest  = new AlexaRequest(
			$fixtureBody,
			['amzn1.ask.skill.e5427198-b2de-4f89-ac18-b54a4877927f'],
			$fixtureHeader['Signaturecertchainurl'],
			$fixtureHeader['Signature'],
			false,
            false
		);

		// Test various properties and sub objects
		$this->assertEquals('1.0', $alexaRequest->getVersion());
		$this->assertArrayHasKey('request', $alexaRequest->getData());
		$this->assertNull($alexaRequest->getContext());
		$this->assertTrue($alexaRequest->getSession()->isNew());
		$this->assertStringStartsWith('amzn1.echo-api.session.', $alexaRequest->getSession()->getSessionId());
		$this->assertStringStartsWith('amzn1.ask.skill.', $alexaRequest->getSession()->getApplication()->getApplicationId());
		$this->assertStringStartsWith('amzn1.ask.account.', $alexaRequest->getSession()->getUser()->getUserId());
		$this->assertEquals('lo6539ti9xbd54ng', $alexaRequest->getSession()->getUser()->getAccessToken());

		// Test shortcuts to sub objects
		$this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\Application', get_class($alexaRequest->getApplication()));
		$this->assertStringStartsWith('amzn1.ask.skill.', $alexaRequest->getApplication()->getApplicationId());
		$this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\User', get_class($alexaRequest->getUser()));
		$this->assertStringStartsWith('amzn1.ask.account.', $alexaRequest->getUser()->getUserId());
		$this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\Request\Intent\Intent', get_class($alexaRequest->getIntent()));
	}

	/**
	 * testSessionEndedRequest
	 */
	public function testSessionEndedRequest() {
		$fixtureHeader = json_decode(file_get_contents(__DIR__ . '/Fixtures/SessionEndedRequest-Header.json'), true);
		$fixtureBody   = trim(file_get_contents(__DIR__ . '/Fixtures/SessionEndedRequest-Body.txt'));
		$alexaRequest  = new AlexaRequest(
			$fixtureBody,
			['amzn1.ask.skill.e5427198-b2de-4f89-ac18-b54a4877927f'],
			$fixtureHeader['Signaturecertchainurl'],
			$fixtureHeader['Signature'],
			false,
            false
		);

		// Test various properties and sub objects
		$this->assertEquals('1.0', $alexaRequest->getVersion());
		$this->assertFalse($alexaRequest->getSession()->isNew());
		$this->assertStringStartsWith('amzn1.echo-api.session.', $alexaRequest->getSession()->getSessionId());
		$this->assertStringStartsWith('amzn1.ask.skill.', $alexaRequest->getSession()->getApplication()->getApplicationId());
		$this->assertStringStartsWith('amzn1.ask.account.', $alexaRequest->getSession()->getUser()->getUserId());
		$this->assertEquals('lo6539ti9xbd54ng', $alexaRequest->getSession()->getUser()->getAccessToken());

		// Test shortcuts to sub objects
		$this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\Application', get_class($alexaRequest->getApplication()));
		$this->assertStringStartsWith('amzn1.ask.skill.', $alexaRequest->getApplication()->getApplicationId());
		$this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\User', get_class($alexaRequest->getUser()));
		$this->assertStringStartsWith('amzn1.ask.account.', $alexaRequest->getUser()->getUserId());

		// Test Request
		/** @var SessionEndedRequest $request */
		$request = $alexaRequest->getRequest();
		$this->assertEquals('SessionEndedRequest', $request->getType());
		$this->assertEquals('ERROR', $request->getReason());
		$this->assertEquals('INVALID_RESPONSE', $request->getError()->type);
		$this->assertStringStartsWith('An exception occurred', $request->getError()->message);
	}

	/**
	 * testAudioPlayerPlaybackStarted
	 */
	public function testAudioPlayerPlaybackStarted() {
		$fixtureBody  = trim(file_get_contents(__DIR__ . '/Fixtures/AudioPlayer.PlaybackStarted.json'));
		$alexaRequest = new AlexaRequest($fixtureBody, ['amzn1.ask.skill.123'], '', '', false, false);

		/** @var PlaybackStarted $request */
		$request = $alexaRequest->getRequest();
		$this->assertEquals('AudioPlayer.PlaybackStarted', $request->getType());
		$this->assertEquals('token', $request->getToken());
		$this->assertEquals(1000, $request->getOffsetInMilliseconds());
	}

	/**
	 * testAudioPlayerPlaybackFailed
	 */
	public function testAudioPlayerPlaybackFailed() {
		$fixtureBody  = trim(file_get_contents(__DIR__ . '/Fixtures/AudioPlayer.PlaybackFailed.json'));
		$alexaRequest = new AlexaRequest($fixtureBody, ['amzn1.ask.skill.123'], '', '', false, false);

		/** @var PlaybackFailed $request */
		$request = $alexaRequest->getRequest();
		$this->assertEquals('AudioPlayer.PlaybackFailed', $request->getType());
		$this->assertEquals('token', $request->getToken());
		$this->assertEquals('ERROR_TYPE', $request->getError()->type);
		$this->assertEquals('Error message', $request->getError()->message);
		$this->assertEquals('token', $request->getCurrentPlaybackState()->getToken());
		$this->assertEquals('IDLE', $request->getCurrentPlaybackState()->getPlayerActivity());
		$this->assertEquals(1000, $request->getCurrentPlaybackState()->getOffsetInMilliseconds());
	}

	/**
	 * testSystemExceptionEncountered
	 */
	public function testSystemExceptionEncountered() {
		$fixtureBody  = trim(file_get_contents(__DIR__ . '/Fixtures/System.ExceptionEncountered.json'));
		$alexaRequest = new AlexaRequest($fixtureBody, ['amzn1.ask.skill.123'], '', '', false, false);

		/** @var ExceptionEncountered $request */
		$request = $alexaRequest->getRequest();
		$this->assertEquals('System.ExceptionEncountered', $request->getType());
		$this->assertEquals('ERROR_TYPE', $request->getError()->type);
		$this->assertEquals('Error message', $request->getError()->message);
		$this->assertStringStartsWith('amzn1.echo-api.request.', $request->getCause()->requestId);
	}

	/**
	 * testInvalidApplicationId
	 */
	public function testInvalidApplicationId() {
		$fixtureHeader = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Header.json'), true);
		$fixtureBody   = trim(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'));

		$this->expectException(InvalidArgumentException::class);
		new AlexaRequest(
			$fixtureBody,
			[], // empty applicationId
			$fixtureHeader['Signaturecertchainurl'],
			$fixtureHeader['Signature'],
			false,
            false
		);
	}

	/**
	 * testInvalidApplicationId2
	 */
	public function testInvalidApplicationId2() {
		$fixtureHeader = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Header.json'), true);
		$fixtureBody   = trim(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'));

		$this->expectException(InvalidArgumentException::class);
		new AlexaRequest(
			$fixtureBody,
			['amzn1.ask.skill.INVALID_APP_ID'], // invalid applicationId
			$fixtureHeader['Signaturecertchainurl'],
			$fixtureHeader['Signature'],
			false,
            false
		);
	}

	/**
	 * testInvalidSignature
	 */
	public function testInvalidSignature() {
		$fixtureHeader = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Header.json'), true);
		$fixtureBody   = trim(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'));

		$this->expectException(InvalidArgumentException::class);
		new AlexaRequest(
			$fixtureBody,
			['amzn1.ask.skill.e5427198-b2de-4f89-ac18-b54a4877927f'],
			$fixtureHeader['Signaturecertchainurl'],
			base64_encode('INVALID_SIGNATURE'), // invalid signature
			false
		);
	}

	/**
	 * testInvalidSignedBody
	 */
	public function testInvalidSignedBody() {
		$fixtureHeader = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Header.json'), true);

		$this->expectException(InvalidArgumentException::class);
		new AlexaRequest(
			'INVALID_BODY_CONTENT', // invalid request body
			['amzn1.ask.skill.e5427198-b2de-4f89-ac18-b54a4877927f'],
			$fixtureHeader['Signaturecertchainurl'],
			$fixtureHeader['Signature'],
			false,
            false
		);
	}

	/**
	 * testInvalidTimestamp
	 */
	public function testInvalidTimestamp() {
		$fixtureHeader = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Header.json'), true);
		$fixtureBody   = trim(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'));

		$this->expectException(InvalidArgumentException::class);
		new AlexaRequest(
			$fixtureBody,
			['amzn1.ask.skill.e5427198-b2de-4f89-ac18-b54a4877927f'],
			$fixtureHeader['Signaturecertchainurl'],
			$fixtureHeader['Signature']
			// Timestamp in fixture is too old
		);
	}

	/**
	 * testContext
	 */
	public function testContext() {
		$fixtureHeader = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Header.json'), true);
		$fixtureBody   = trim(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'));

		// Destroy session and Context
		$temp = json_decode($fixtureBody, true);
		unset($temp['session']);
		$fixtureBody = json_encode($temp);

		// Expect Exception due to modified contents (wrong signature)
		$this->expectException(InvalidArgumentException::class);
		new AlexaRequest(
			$fixtureBody,
			['amzn1.ask.skill.e5427198-b2de-4f89-ac18-b54a4877927f'],
			$fixtureHeader['Signaturecertchainurl'],
			$fixtureHeader['Signature'],
			false
		);
	}

	/**
	 * testMissingSessionAndContext
	 */
	public function testMissingSessionAndContext() {
		$fixtureHeader = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Header.json'), true);
		$fixtureBody   = trim(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'));

		// Destroy session and Context
		$temp = json_decode($fixtureBody, true);
		unset($temp['session']);
		unset($temp['context']);
		$fixtureBody = json_encode($temp);

		$this->expectException(InvalidArgumentException::class);
		new AlexaRequest(
			$fixtureBody,
			['amzn1.ask.skill.e5427198-b2de-4f89-ac18-b54a4877927f'],
			$fixtureHeader['Signaturecertchainurl'],
			$fixtureHeader['Signature'],
			false,
            false
		);
	}
}
