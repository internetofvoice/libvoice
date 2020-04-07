<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\GameEngine;

use \DateTime;
use \Exception;


/**
 * Class InputEvent
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class InputEvent {
	/** @var string $gadgetId */
	protected $gadgetId;

	/** @var DateTime $timestamp */
	protected $timestamp;

	/** @var string $action */
	protected $action;

	/** @var string $color */
	protected $color;

	/** @var string $feature */
	protected $feature;


	/**
	 * @param array $requestData
	 */
	public function __construct(array $requestData) {
		if(isset($requestData['gadgetId'])) {
			$this->gadgetId = $requestData['gadgetId'];
		}

		if(isset($requestData['timestamp'])) {
			$timestamp = is_numeric($requestData['timestamp']) ? '@' . substr($requestData['timestamp'], 0, 10) : $requestData['timestamp'];
			try {
				$this->timestamp = new DateTime($timestamp);
			} catch(Exception $e) {
				$this->timestamp = null;
			}
		}

		if(isset($requestData['action'])) {
			$this->action = $requestData['action'];
		}

		if(isset($requestData['color'])) {
			$this->color = $requestData['color'];
		}

		if(isset($requestData['feature'])) {
			$this->feature = $requestData['feature'];
		}
	}


	/**
	 * @return string
	 */
	public function getGadgetId(): string  {
		return $this->gadgetId;
	}

	/**
	 * @return DateTime
	 */
	public function getTimestamp(): DateTime {
		return $this->timestamp;
	}

	/**
	 * @return string
	 */
	public function getAction(): string  {
		return $this->action;
	}

	/**
	 * @return string
	 */
	public function getColor(): string  {
		return $this->color;
	}

	/**
	 * @return string
	 */
	public function getFeature(): string  {
		return $this->feature;
	}
}
