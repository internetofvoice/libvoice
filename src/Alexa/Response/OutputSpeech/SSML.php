<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\OutputSpeech;

/**
 * Class SSML
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class SSML extends AbstractOutputSpeech {
	/** @var string $ssml */
	protected $ssml;


	/**
	 * @param string $ssml
	 */
	public function __construct(string $ssml) {
		parent::__construct();

		$this->type = 'SSML';
		$this->setSSML($ssml);
	}


	/**
	 * @return string
	 */
	public function getSSML(): string {
		return $this->ssml;
	}

	/**
	 * @param string $ssml
	 *
	 * @return SSML
	 */
	public function setSSML(string $ssml) {
		$this->ssml = mb_substr($ssml, 0, self::MAX_CONTENT_CHARS, 'UTF-8');

		return $this;
	}

	/**
	 * @return array
	 */
	public function render(): array {
		$result = [
			'type' => $this->getType(),
			'ssml' => $this->getSSML(),
		];

		if($playBehavior = $this->getPlayBehavior()) {
			$result['playBehavior'] = $playBehavior;
		}

		return $result;
	}
}
