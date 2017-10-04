<?php

namespace Tests\Alexa\Request;

use InternetOfVoice\LibVoice\Alexa\Request\CertificateValidator;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


/**
 * Class CertificateValidatorTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class CertificateValidatorTest extends TestCase {
	/**
	 * testCertificateValidator
	 */
	public function testCertificateValidator() {
        $fixtureHeader = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Header.json'), true);
        $fixtureBody = trim(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'));
        $validator = new CertificateValidator(
            $fixtureHeader['Signaturecertchainurl'],
            $fixtureHeader['Signature']
        );

        $this->assertTrue($validator->validateRequest($fixtureBody, false));

        $this->expectException(InvalidArgumentException::class);
        $validator->validateRequest($fixtureBody);
	}
}
