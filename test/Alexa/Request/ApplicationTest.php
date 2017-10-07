<?php

namespace Tests\Alexa\Request;

use InternetOfVoice\LibVoice\Alexa\Request\Application;
use PHPUnit\Framework\TestCase;


/**
 * Class ApplicationTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ApplicationTest extends TestCase {
	/**
	 * testApplication
	 */
	public function testApplication() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'), true);
		$application = new Application($fixture['session']['application']);
		$this->assertStringStartsWith('amzn1.ask.skill.', $application->getApplicationId());
	}
}
