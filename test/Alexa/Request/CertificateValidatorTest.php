<?php

namespace Tests\Alexa\Request;

use \InternetOfVoice\LibVoice\Alexa\Request\CertificateValidator;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class CertificateValidatorTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class CertificateValidatorTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testCertificateValidator() {
        $fixtureHeader = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Header.json'), true);
        $fixtureBody = trim(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'));
        $validator = new CertificateValidator(
            $fixtureHeader['Signaturecertchainurl'],
            $fixtureHeader['Signature']
        );

        // This fails if Amazon exchanges certificates.
        // $this->assertTrue($validator->validateRequest($fixtureBody, false));

        $this->assertTrue($validator->validateTimestamp(strval(time() * 1000)));

        $this->expectException(InvalidArgumentException::class);
        $validator->validateRequest($fixtureBody);
	}

	/**
	 * @group custom-skill
	 */
    public function testSignatureCertificateURLProtocol() {
        $validator = new CertificateValidator('http://www.example.com', 'SIGNATURE');
        $this->expectException(InvalidArgumentException::class);
        $validator->verifySignatureCertificateURL();
    }

	/**
	 * @group custom-skill
	 */
    public function testSignatureCertificateURLHost() {
        $validator = new CertificateValidator('https://www.example.com', 'SIGNATURE');
        $this->expectException(InvalidArgumentException::class);
        $validator->verifySignatureCertificateURL();
    }

	/**
	 * @group custom-skill
	 */
    public function testSignatureCertificateURLPath() {
        $validator = new CertificateValidator('https://s3.amazonaws.com:443/path', 'SIGNATURE');
        $this->expectException(InvalidArgumentException::class);
        $validator->verifySignatureCertificateURL();
    }

	/**
	 * @group custom-skill
	 */
    public function testSignatureCertificateURLPort() {
        $validator = new CertificateValidator('https://s3.amazonaws.com:80/echo.api/', 'SIGNATURE');
        $this->expectException(InvalidArgumentException::class);
        $validator->verifySignatureCertificateURL();
    }
}
