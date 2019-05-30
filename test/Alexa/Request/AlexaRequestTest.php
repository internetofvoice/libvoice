<?php

namespace Tests\Alexa\Request;

use \Exception;
use \InternetOfVoice\LibVoice\Alexa\Request\AlexaRequest;
use \InternetOfVoice\LibVoice\Alexa\Request\Context;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\AudioPlayer\PlaybackFailed;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\AudioPlayer\PlaybackFinished;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\AudioPlayer\PlaybackNearlyFinished;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\AudioPlayer\PlaybackStarted;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\AudioPlayer\PlaybackStopped;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\Display\ElementSelected;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\GameEngine\InputHandlerEvent;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\PlaybackController\NextCommandIssued;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\PlaybackController\PauseCommandIssued;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\PlaybackController\PlayCommandIssued;
use \InternetOfVoice\LibVoice\Alexa\Request\Request\PlaybackController\PreviousCommandIssued;
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
	 * @group  custom-skill
	 * @throws Exception
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
		$this->assertInstanceOf(Context::class, $alexaRequest->getContext());
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

		// Test invalid timestamp
		$json = json_decode($fixtureBody, true);
		$json['request']['timestamp'] = 'NOT-A-TIMESTAMP';
		$alexaRequest = new AlexaRequest(json_encode($json), ['amzn1.ask.skill.e5427198-b2de-4f89-ac18-b54a4877927f'], '', '', false, false);
		/** @var InputHandlerEvent $request */
		$request = $alexaRequest->getRequest();
		$this->assertNull($request->getTimestamp());
	}

	/**
	 * @group  custom-skill
	 * @throws Exception
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
		$this->assertEquals('INVALID_RESPONSE', $request->getError()->getType());
		$this->assertStringStartsWith('An exception occurred', $request->getError()->getMessage());
	}

	/**
	 * @group  custom-skill
	 * @throws Exception
	 */
	public function testLaunchRequest() {
		$body = [
			'version' => '1.0',
			'request' => [
				'type'      => 'LaunchRequest',
				'requestId' => 'amzn1.echo-api.request.123',
				'timestamp' => '2017-09-23T17:54:48Z',
				'locale'    => 'en-GB',
			],
			'session' => [
				'new'         => false,
				'sessionId'   => 'amzn1.echo-api.session.123',
				'application' => [
					'applicationId' => 'amzn1.ask.skill.123',
				],
				'user' => [
					'userId'      => 'amzn1.ask.account.123',
					'accessToken' => 'token',
				],
			],
		];

		$alexaRequest = new AlexaRequest(json_encode($body), ['amzn1.ask.skill.123'], 'Signaturecertchainurl', 'Signature', false, false);
		$this->assertEquals('LaunchRequest', $alexaRequest->getRequest()->getType());
	}

	/**
	 * @group  custom-skill
	 * @throws Exception
	 */
	public function testLaunchRequestException1() {
		$body = [
			'version' => '1.0',
			'request' => [
				'requestId' => 'amzn1.echo-api.request.123',
				'timestamp' => '2017-09-23T17:54:48Z',
				'locale'    => 'en-GB',
			],
			'session' => [
				'new'         => false,
				'sessionId'   => 'amzn1.echo-api.session.123',
				'application' => [
					'applicationId' => 'amzn1.ask.skill.123',
				],
				'user' => [
					'userId'      => 'amzn1.ask.account.123',
					'accessToken' => 'token',
				],
			],
		];

		$this->expectException(InvalidArgumentException::class);
		new AlexaRequest(json_encode($body), ['amzn1.ask.skill.123'], 'Signaturecertchainurl', 'Signature', false, false);
	}

	/**
	 * @group  custom-skill
	 * @throws Exception
	 */
	public function testLaunchRequestException2() {
		$body = [
			'version' => '1.0',
			'request' => [
				'type'      => 'Unknown.Request.Type',
				'requestId' => 'amzn1.echo-api.request.123',
				'timestamp' => '2017-09-23T17:54:48Z',
				'locale'    => 'en-GB',
			],
			'session' => [
				'new'         => false,
				'sessionId'   => 'amzn1.echo-api.session.123',
				'application' => [
					'applicationId' => 'amzn1.ask.skill.123',
				],
				'user' => [
					'userId'      => 'amzn1.ask.account.123',
					'accessToken' => 'token',
				],
			],
		];

		$this->expectException(InvalidArgumentException::class);
		new AlexaRequest(json_encode($body), ['amzn1.ask.skill.123'], 'Signaturecertchainurl', 'Signature', false, false);
	}

	/**
	 * @group  custom-skill
	 * @throws Exception
	 */
	public function testIntentRequestException1() {
		$body = [
			'version' => '1.0',
			'request' => [
				'type'      => 'LaunchRequest',
				'requestId' => 'amzn1.echo-api.request.123',
				'timestamp' => '2017-09-23T17:54:48Z',
				'locale'    => 'en-GB',
			],
			'session' => [
				'new'         => false,
				'sessionId'   => 'amzn1.echo-api.session.123',
				'application' => [
					'applicationId' => 'amzn1.ask.skill.123',
				],
				'user' => [
					'userId'      => 'amzn1.ask.account.123',
					'accessToken' => 'token',
				],
			],
		];

		$alexaRequest = new AlexaRequest(json_encode($body), ['amzn1.ask.skill.123'], 'Signaturecertchainurl', 'Signature', false, false);
		$this->expectException(InvalidArgumentException::class);
		$alexaRequest->getIntent();
	}

	/**
	 * @group  custom-skill
	 * @throws Exception
	 */
	public function testDisplayElementSelected() {
		$fixtureBody  = trim(file_get_contents(__DIR__ . '/Fixtures/Display.ElementSelected.json'));
		$alexaRequest = new AlexaRequest($fixtureBody, ['amzn1.ask.skill.123'], '', '', false, false);

		/** @var ElementSelected $request */
		$request = $alexaRequest->getRequest();
		$this->assertEquals('Display.ElementSelected', $request->getType());
		$this->assertEquals('myToken1', $request->getToken());
	}

	/**
	 * @group  custom-skill
	 * @throws Exception
	 */
	public function testGameEngineInputHandlerEvent() {
		$fixtureBody  = trim(file_get_contents(__DIR__ . '/Fixtures/GameEngine.InputHandlerEvent.json'));
		$alexaRequest = new AlexaRequest($fixtureBody, ['amzn1.ask.skill.123'], '', '', false, false);

		/** @var InputHandlerEvent $request */
		$request = $alexaRequest->getRequest();
		$this->assertEquals('GameEngine.InputHandlerEvent', $request->getType());
		$this->assertEquals('amzn1.echo-api.request.789', $request->getOriginatingRequestId());

		// Test Events
		$event = $request->getEvents()[0];
		$this->assertEquals('myEventName', $event->getName());

		// Test InputEvents
		$inputEvent = $event->getInputEvents()[0];
		$this->assertEquals('someGadgetId1', $inputEvent->getGadgetId());
		$this->assertEquals('2017-08-18 01:32:40', $inputEvent->getTimestamp()->format('Y-m-d H:i:s'));
		$this->assertEquals('down', $inputEvent->getAction());
		$this->assertEquals('press', $inputEvent->getFeature());
		$this->assertEquals('FF0000', $inputEvent->getColor());

		// Test invalid timestamp
		$json = json_decode($fixtureBody, true);
		$json['request']['events'][0]['inputEvents'][0]['timestamp'] = 'NOT-A-TIMESTAMP';
		$alexaRequest = new AlexaRequest(json_encode($json), ['amzn1.ask.skill.123'], '', '', false, false);
		/** @var InputHandlerEvent $request */
		$request = $alexaRequest->getRequest();
		$this->assertNull($request->getEvents()[0]->getInputEvents()[0]->getTimestamp());
	}

	/**
	 * @group  custom-skill
	 * @throws Exception
	 */
	public function testAudioPlayerPlaybackFailed() {
		$fixtureBody  = trim(file_get_contents(__DIR__ . '/Fixtures/AudioPlayer.PlaybackFailed.json'));
		$alexaRequest = new AlexaRequest($fixtureBody, ['amzn1.ask.skill.123'], '', '', false, false);

		/** @var PlaybackFailed $request */
		$request = $alexaRequest->getRequest();
		$this->assertEquals('AudioPlayer.PlaybackFailed', $request->getType());
		$this->assertEquals('token', $request->getToken());
		$this->assertEquals('ERROR_TYPE', $request->getError()->getType());
		$this->assertEquals('Error message', $request->getError()->getMessage());
		$this->assertEquals('token', $request->getCurrentPlaybackState()->getToken());
		$this->assertEquals('IDLE', $request->getCurrentPlaybackState()->getPlayerActivity());
		$this->assertEquals(1000, $request->getCurrentPlaybackState()->getOffsetInMilliseconds());
	}

	/**
	 * @group  custom-skill
	 * @throws Exception
	 */
	public function testAudioPlayerPlaybackFinished() {
		$fixtureBody  = trim(file_get_contents(__DIR__ . '/Fixtures/AudioPlayer.PlaybackFinished.json'));
		$alexaRequest = new AlexaRequest($fixtureBody, ['amzn1.ask.skill.123'], '', '', false, false);

		/** @var PlaybackFinished $request */
		$request = $alexaRequest->getRequest();
		$this->assertEquals('AudioPlayer.PlaybackFinished', $request->getType());
		$this->assertEquals('token', $request->getToken());
		$this->assertEquals(1000, $request->getOffsetInMilliseconds());
	}

	/**
	 * @group  custom-skill
	 * @throws Exception
	 */
	public function testAudioPlayerPlaybackNearlyFinished() {
		$fixtureBody  = trim(file_get_contents(__DIR__ . '/Fixtures/AudioPlayer.PlaybackNearlyFinished.json'));
		$alexaRequest = new AlexaRequest($fixtureBody, ['amzn1.ask.skill.123'], '', '', false, false);

		/** @var PlaybackNearlyFinished $request */
		$request = $alexaRequest->getRequest();
		$this->assertEquals('AudioPlayer.PlaybackNearlyFinished', $request->getType());
		$this->assertEquals('token', $request->getToken());
		$this->assertEquals(1000, $request->getOffsetInMilliseconds());
	}

	/**
	 * @group  custom-skill
	 * @throws Exception
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
	 * @group  custom-skill
	 * @throws Exception
	 */
	public function testAudioPlayerPlaybackStopped() {
		$fixtureBody  = trim(file_get_contents(__DIR__ . '/Fixtures/AudioPlayer.PlaybackStopped.json'));
		$alexaRequest = new AlexaRequest($fixtureBody, ['amzn1.ask.skill.123'], '', '', false, false);

		/** @var PlaybackStopped $request */
		$request = $alexaRequest->getRequest();
		$this->assertEquals('AudioPlayer.PlaybackStopped', $request->getType());
		$this->assertEquals('token', $request->getToken());
		$this->assertEquals(21874, $request->getOffsetInMilliseconds());
	}

	/**
	 * @group  custom-skill
	 * @throws Exception
	 */
	public function testPlaybackControllerNextCommandIssued() {
		$fixtureBody  = trim(file_get_contents(__DIR__ . '/Fixtures/PlaybackController.NextCommandIssued.json'));
		$alexaRequest = new AlexaRequest($fixtureBody, ['amzn1.ask.skill.123'], '', '', false, false);

		/** @var NextCommandIssued $request */
		$request = $alexaRequest->getRequest();
		$this->assertEquals('PlaybackController.NextCommandIssued', $request->getType());
	}

	/**
	 * @group  custom-skill
	 * @throws Exception
	 */
	public function testPlaybackControllerPauseCommandIssued() {
		$fixtureBody  = trim(file_get_contents(__DIR__ . '/Fixtures/PlaybackController.PauseCommandIssued.json'));
		$alexaRequest = new AlexaRequest($fixtureBody, ['amzn1.ask.skill.123'], '', '', false, false);

		/** @var PauseCommandIssued $request */
		$request = $alexaRequest->getRequest();
		$this->assertEquals('PlaybackController.PauseCommandIssued', $request->getType());
	}

	/**
	 * @group  custom-skill
	 * @throws Exception
	 */
	public function testPlaybackControllerPlayCommandIssued() {
		$fixtureBody  = trim(file_get_contents(__DIR__ . '/Fixtures/PlaybackController.PlayCommandIssued.json'));
		$alexaRequest = new AlexaRequest($fixtureBody, ['amzn1.ask.skill.123'], '', '', false, false);

		/** @var PlayCommandIssued $request */
		$request = $alexaRequest->getRequest();
		$this->assertEquals('PlaybackController.PlayCommandIssued', $request->getType());
	}

	/**
	 * @group  custom-skill
	 * @throws Exception
	 */
	public function testPlaybackControllerPreviousCommandIssued() {
		$fixtureBody  = trim(file_get_contents(__DIR__ . '/Fixtures/PlaybackController.PreviousCommandIssued.json'));
		$alexaRequest = new AlexaRequest($fixtureBody, ['amzn1.ask.skill.123'], '', '', false, false);

		/** @var PreviousCommandIssued $request */
		$request = $alexaRequest->getRequest();
		$this->assertEquals('PlaybackController.PreviousCommandIssued', $request->getType());
	}

	/**
	 * @group  custom-skill
	 * @throws Exception
	 */
	public function testSystemExceptionEncountered() {
		$fixtureBody  = trim(file_get_contents(__DIR__ . '/Fixtures/System.ExceptionEncountered.json'));
		$alexaRequest = new AlexaRequest($fixtureBody, ['amzn1.ask.skill.123'], '', '', false, false);

		/** @var ExceptionEncountered $request */
		$request = $alexaRequest->getRequest();
		$this->assertEquals('System.ExceptionEncountered', $request->getType());
		$this->assertEquals('ERROR_TYPE', $request->getError()->getType());
		$this->assertEquals('Error message', $request->getError()->getMessage());
		$this->assertStringStartsWith('amzn1.echo-api.request.', $request->getCause()->getRequestId());
	}

	/**
	 * @group  custom-skill
	 * @throws Exception
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
	 * @group  custom-skill
	 * @throws Exception
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
	 * @group  custom-skill
	 * @throws Exception
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
	 * @group  custom-skill
	 * @throws Exception
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
	 * @group  custom-skill
	 * @throws Exception
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
	 * @group  custom-skill
	 * @throws Exception
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
	 * @group  custom-skill
	 * @throws Exception
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
