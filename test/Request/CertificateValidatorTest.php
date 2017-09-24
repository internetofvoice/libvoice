<?php

namespace Tests\Request;

use \Alexa\Request\CertificateValidator;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;


class CertificateValidatorTest extends TestCase {
	/**
	 * testCertificateValidator
	 */
	public function testCertificateValidator() {
        $fixtureHeader = json_decode(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest-Header.json'), true);
        $fixtureBody = trim(file_get_contents(__DIR__ . '/../Fixtures/IntentRequest-Body.txt'));
        $validator = new CertificateValidator(
            $fixtureHeader['Signaturecertchainurl'],
            $fixtureHeader['Signature']
        );

        $this->assertTrue($validator->validateRequest($fixtureBody, false));

        $this->expectException(InvalidArgumentException::class);
        $validator->validateRequest($fixtureBody);
	}
}
