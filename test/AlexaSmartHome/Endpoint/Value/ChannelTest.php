<?php

namespace Tests\AlexaSmartHome\Endpoint\Value;

use \InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint\Value\Channel;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class ChannelTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ChannelTest extends TestCase {
	/**
	 * @group smarthome
	 */
	public function testChannelCreate() {
        $channel = Channel::create()
            ->setNumber('1')
            ->setCallSign('ARD')
            ->setAffiliateCallSign('WDR')
            ->setUri('URI')
        ;

		$expect = [
			'number' => '1',
			'callSign' => 'ARD',
			'affiliateCallSign' => 'WDR',
			'uri' => 'URI',
		];

		$this->assertEquals($expect, $channel->render());
	}

	/**
     * @group smarthome
     */
    public function testChannelCreateFromArray() {
        $fixture = [
            'number' => '1',
            'callSign' => 'ARD',
            'affiliateCallSign' => 'WDR',
            'uri' => 'URI',
        ];

        $channel = Channel::createFromArray($fixture);
        $this->assertEquals($fixture, $channel->render());
    }

	/**
	 * @group smarthome
	 */
	public function testMissingValue() {
		$channel = new Channel();
		$this->expectException(InvalidArgumentException::class);
		$channel->render();
	}

    /**
     * @group smarthome
     */
    public function testMissingValueFromArray() {
        $this->expectException(InvalidArgumentException::class);
        Channel::createFromArray([]);
    }
}
