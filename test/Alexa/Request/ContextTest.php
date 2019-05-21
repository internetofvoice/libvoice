<?php

namespace Tests\Alexa\Request;

use \InternetOfVoice\LibVoice\Alexa\Request\Context;
use \PHPUnit\Framework\TestCase;

/**
 * Class ContextTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ContextTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testContext() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/Fixtures/IntentRequest-Body.txt'), true);

		// Complement missing fixture data
		$fixture['context']['Display'] = [
			'templateVersion' => '1',
			'markupVersion' => '2',
			'token' => 'TOKEN',
		];

		$context = new Context($fixture['context']);
        $this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\Context\AudioPlayer', get_class($context->getAudioPlayer()));
        $this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\Context\Display', get_class($context->getDisplay()));
        $this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\Context\System', get_class($context->getSystem()));
	}

	/**
	 * @group custom-skill
	 */
	public function testViewport() {
		$fixture = json_decode(file_get_contents(__DIR__ . '/Fixtures/Viewport.json'), true);

		$context = new Context($fixture['context']);
		$this->assertEquals('RECTANGLE', $context->getViewport()->getShape());
		$this->assertEquals(1280, $context->getViewport()->getPixelWidth());
		$this->assertEquals(800, $context->getViewport()->getPixelHeight());
		$this->assertEquals(160, $context->getViewport()->getDpi());
		$this->assertEquals(160, $context->getViewport()->getDpi());
		$this->assertEquals(1280, $context->getViewport()->getCurrentPixelWidth());
		$this->assertEquals(800, $context->getViewport()->getCurrentPixelHeight());
		$this->assertEquals(['SINGLE'], $context->getViewport()->getTouch());
		$this->assertEquals(['DIRECTION'], $context->getViewport()->getKeyboard());

		$experiences = $context->getViewport()->getExperiences()[0];
		$this->assertEquals('InternetOfVoice\LibVoice\Alexa\Request\Context\Viewport\Experience', get_class($experiences));
		$this->assertEquals(346, $experiences->getArcMinuteWidth());
		$this->assertEquals(216, $experiences->getArcMinuteHeight());
		$this->assertEquals(false, $experiences->canRotate());
		$this->assertEquals(true, $experiences->canResize());
	}
}
