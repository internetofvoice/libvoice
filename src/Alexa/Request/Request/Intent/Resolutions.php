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
	public function __construct(array $data = []) {
		if(isset($data['resolutionsPerAuthority'])) {
			foreach($data['resolutionsPerAuthority'] as $resolutionsPerAuthority) {
				array_push($this->resolutionsPerAuthority, new ResolutionPerAuthority($resolutionsPerAuthority));
			}
		}
	}


	/**
	 * @return ResolutionPerAuthority[]
	 */
	public function getResolutionsPerAuthority(): array {
		return $this->resolutionsPerAuthority;
	}

	/**
	 * @param  ResolutionPerAuthority[] $resolutionsPerAuthority
	 *
	 * @return Resolutions
	 */
	public function setResolutionsPerAuthority(array $resolutionsPerAuthority): Resolutions {
		$this->resolutionsPerAuthority = [];
		foreach($resolutionsPerAuthority as $resolutionPerAuthority) {
			$this->addResolutionPerAuthority($resolutionPerAuthority);
		}

		return $this;
	}

	/**
	 * @param  ResolutionPerAuthority $resolutionPerAuthority
	 *
	 * @return Resolutions
	 */
	public function addResolutionPerAuthority(ResolutionPerAuthority $resolutionPerAuthority): Resolutions {
		array_push($this->resolutionsPerAuthority, $resolutionPerAuthority);

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		$result = [];

		$resolutionsPerAuthority = $this->getResolutionsPerAuthority();
		if(count($resolutionsPerAuthority)) {
			$result['resolutionsPerAuthority'] = [];
			foreach($resolutionsPerAuthority as $resolutionPerAuthority) {
				array_push($result['resolutionsPerAuthority'], $resolutionPerAuthority->render());
			}
		}

		return $result;
	}}
