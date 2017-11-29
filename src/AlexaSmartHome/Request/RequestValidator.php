<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Request;

use \DateTime;
use \DateTimeZone;
use \InvalidArgumentException;

/**
 * Class RequestValidator
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class RequestValidator {
	/** @var int TIMESTAMP_TOLERANCE */
	const TIMESTAMP_TOLERANCE = 60;

	/**
	 * @param  string $data
	 * @param  string $signature
	 * @param  string $secret
	 * @return bool
	 * @throws InvalidArgumentException
	 */
	public static function validateSignature($data, $signature, $secret) {
		$hash = hash_hmac('sha512', $data, $secret);
		if($hash !== $signature) {
			throw new InvalidArgumentException('Request signature validation failed.');
		}

		return true;
	}

	/**
	 * @param  string $timestamp
	 * @param  string $timezone (default UTC)
	 * @return bool
	 * @throws InvalidArgumentException
	 */
	public static function validateTimestamp($timestamp, $timezone = 'UTC') {
		$time = new DateTime($timestamp); // may throw an exception for an unknown timestamp format
		$now  = new DateTime(null, new DateTimeZone($timezone));
		$diff = $now->getTimestamp() - $time->getTimestamp();
		if($diff > self::TIMESTAMP_TOLERANCE) {
			throw new InvalidArgumentException('Request timestamp is too old.');
		}

		return true;
	}
}
