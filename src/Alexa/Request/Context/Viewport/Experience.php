<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Context\Viewport;

/**
 * Class Experience
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Experience {
	/** @var int $arcMinuteWidth */
	protected $arcMinuteWidth;

	/** @var int $arcMinuteHeight */
	protected $arcMinuteHeight;

	/** @var bool $canRotate */
	protected $canRotate;

	/** @var bool $canResize */
	protected $canResize;


	/**
	 * @param array $viewportData
	 */
	public function __construct(array $viewportData) {
		if(isset($viewportData['arcMinuteWidth'])) {
			$this->arcMinuteWidth = intval($viewportData['arcMinuteWidth']);
		}

		if(isset($viewportData['arcMinuteHeight'])) {
			$this->arcMinuteHeight = intval($viewportData['arcMinuteHeight']);
		}

		if(isset($viewportData['canRotate'])) {
			$this->canRotate = boolval($viewportData['canRotate']);
		}

		if(isset($viewportData['canResize'])) {
			$this->canResize = boolval($viewportData['canResize']);
		}
	}


	/**
	 * @return int
	 */
	public function getArcMinuteWidth(): int {
		return $this->arcMinuteWidth;
	}

	/**
	 * @return int
	 */
	public function getArcMinuteHeight(): int  {
		return $this->arcMinuteHeight;
	}

	/**
	 * @return bool
	 */
	public function canRotate(): bool {
		return $this->canRotate;
	}

	/**
	 * @return bool
	 */
	public function canResize(): bool {
		return $this->canResize;
	}
}
