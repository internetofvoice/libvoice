<?php

namespace Tests\Request;

use \Alexa\Request\AlexaRequest;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;


class RequestTest extends TestCase {
	/**
	 * testIntentRequest
	 */
	public function testIntentRequest() {
		$fixtureHeader = json_decode(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest-Header.json'), true);
		$fixtureBody   = trim(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest-Body.txt'));
		$alexaRequest  = new AlexaRequest(
			$fixtureBody,
			['amzn1.ask.skill.e5427198-b2de-4f89-ac18-b54a4877927f'],
			$fixtureHeader['Signaturecertchainurl'],
			$fixtureHeader['Signature'],
			false
		);

		$this->assertEquals('1.0', $alexaRequest->getVersion());
		$this->assertTrue($alexaRequest->getSession()->isNew());
		$this->assertStringStartsWith('amzn1.echo-api.session.', $alexaRequest->getSession()->getSessionId());
		$this->assertStringStartsWith('amzn1.ask.skill.', $alexaRequest->getSession()->getApplication()->getApplicationId());
		$this->assertStringStartsWith('amzn1.ask.account.', $alexaRequest->getSession()->getUser()->getUserId());
		$this->assertEquals('lo6539ti9xbd54ng', $alexaRequest->getSession()->getUser()->getAccessToken());
	}

	/**
	 * testInvalidApplicationId
	 */
	public function testInvalidApplicationId() {
		$fixtureHeader = json_decode(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest-Header.json'), true);
		$fixtureBody   = trim(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest-Body.txt'));

		$this->expectException(InvalidArgumentException::class);
		new AlexaRequest(
			$fixtureBody,
			['amzn1.ask.skill.INVALID_APP_ID'], // invalid applicationId
			$fixtureHeader['Signaturecertchainurl'],
			$fixtureHeader['Signature'],
			false
		);
	}

	/**
	 * testInvalidSignature
	 */
	public function testInvalidSignature() {
		$fixtureHeader = json_decode(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest-Header.json'), true);
		$fixtureBody   = trim(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest-Body.txt'));

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
		$fixtureHeader = json_decode(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest-Header.json'), true);

		$this->expectException(InvalidArgumentException::class);
		new AlexaRequest(
			'INVALID_BODY_CONTENT', // invalid request body
			['amzn1.ask.skill.e5427198-b2de-4f89-ac18-b54a4877927f'],
			$fixtureHeader['Signaturecertchainurl'],
			$fixtureHeader['Signature'],
			false
		);
	}

	/**
	 * testInvalidTimestamp
	 */
	public function testInvalidTimestamp() {
		$fixtureHeader = json_decode(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest-Header.json'), true);
		$fixtureBody   = trim(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest-Body.txt'));

		$this->expectException(InvalidArgumentException::class);
		new AlexaRequest(
			$fixtureBody,
			['amzn1.ask.skill.e5427198-b2de-4f89-ac18-b54a4877927f'],
			$fixtureHeader['Signaturecertchainurl'],
			$fixtureHeader['Signature']
			// Timestamp in fixture is too old
		);
	}
}
