<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Request\Intent;

/**
 * Class Resolutions
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Resolutions {
	/** @var ResolutionPerAuthority[] $resolutionsPerAuthority */
	protected $resolutionsPerAuthority = [];


	/**
	 * @param array $data
	 */
	public function __construct($data) {
		if(isset($data['resolutionsPerAuthority'])) {
			foreach($data['resolutionsPerAuthority'] as $resolutionsPerAuthority) {
				array_push($this->resolutionsPerAuthority, new ResolutionPerAuthority($resolutionsPerAuthority));
			}
		}
	}


	/**
	 * @return ResolutionPerAuthority[]
	 */
	public function getResolutionsPerAuthority() {
		return $this->resolutionsPerAuthority;
	}
}
