<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Card;

/**
 * Abstract Class AbstractCard
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
abstract class AbstractCard {
	/** @var int MAX_CONTENT_CHARS */
	const MAX_CONTENT_CHARS = 8000;

	/** @var int MAX_URL_CHARS */
	const MAX_URL_CHARS     = 2000;

	/** @var array CONSENT_PERMISSIONS */
	const CONSENT_PERMISSIONS = [
		'alexa::alerts:reminders:skill:readwrite',
		'alexa::devices:all:address:country_and_postal_code:read',
		'alexa::devices:all:geolocation:read',
		'alexa::devices:all:address:full:read',
		'alexa::devices:all:notifications:write',
		'alexa::household:lists:read',
		'alexa::household:lists:write',
		'alexa::profile:email:read',
		'alexa::profile:given_name:read',
		'alexa::profile:mobile_number:read',
		'alexa::profile:name:read',
	];

	/** @var  string $type */
	protected $type;


	public function __construct() {
	}


	/**
	 * @return string
	 */
	public function getType(): string {
		return $this->type;
	}

	/**
	 * @return array
	 */
	abstract function render(): array;
}
