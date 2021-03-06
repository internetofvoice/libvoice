<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Context;

use \InternetOfVoice\LibVoice\Alexa\Request\Context\Viewport\Experience;

/**
 * Class Viewport
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Viewport {
	/** @var Experience[] $experiences */
	protected $experiences = [];

	/** @var string $shape */
	protected $shape;

	/** @var int $pixelWidth */
	protected $pixelWidth;

	/** @var int $pixelHeight */
	protected $pixelHeight;

	/** @var int $dpi */
	protected $dpi;

	/** @var int $currentPixelWidth */
	protected $currentPixelWidth;

	/** @var int $currentPixelHeight */
	protected $currentPixelHeight;

	/** @var array $touch */
	protected $touch = [];

	/** @var array $keyboard */
	protected $keyboard = [];


	/**
	 * @param array $viewportData
	 */
	public function __construct($viewportData) {
		if(isset($viewportData['experiences'])) {
			foreach($viewportData['experiences'] as $experience) {
				array_push($this->experiences, new Experience($experience));
			}
		}

		if(isset($viewportData['shape'])) {
			$this->shape = $viewportData['shape'];
		}

		if(isset($viewportData['pixelWidth'])) {
			$this->pixelWidth = intval($viewportData['pixelWidth']);
		}

		if(isset($viewportData['pixelHeight'])) {
			$this->pixelHeight = intval($viewportData['pixelHeight']);
		}

		if(isset($viewportData['dpi'])) {
			$this->dpi = intval($viewportData['dpi']);
		}

		if(isset($viewportData['currentPixelWidth'])) {
			$this->currentPixelWidth = intval($viewportData['currentPixelWidth']);
		}

		if(isset($viewportData['currentPixelHeight'])) {
			$this->currentPixelHeight = intval($viewportData['currentPixelHeight']);
		}

		if(isset($viewportData['touch'])) {
			$this->touch = $viewportData['touch'];
		}

		if(isset($viewportData['keyboard'])) {
			$this->keyboard = $viewportData['keyboard'];
		}
	}


	/**
	 * @return Experience[]
	 */
	public function getExperiences() {
		return $this->experiences;
	}

	/**
	 * @return string
	 */
	public function getShape() {
		return $this->shape;
	}

	/**
	 * @return int
	 */
	public function getPixelWidth() {
		return $this->pixelWidth;
	}

	/**
	 * @return int
	 */
	public function getPixelHeight() {
		return $this->pixelHeight;
	}

	/**
	 * @return int
	 */
	public function getDpi() {
		return $this->dpi;
	}

	/**
	 * @return int
	 */
	public function getCurrentPixelWidth() {
		return $this->currentPixelWidth;
	}

	/**
	 * @return int
	 */
	public function getCurrentPixelHeight() {
		return $this->currentPixelHeight;
	}

	/**
	 * @return array
	 */
	public function getTouch() {
		return $this->touch;
	}

	/**
	 * @return array
	 */
	public function getKeyboard() {
		return $this->keyboard;
	}
}
