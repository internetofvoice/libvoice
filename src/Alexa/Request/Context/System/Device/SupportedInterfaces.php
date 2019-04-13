<?php

namespace InternetOfVoice\LibVoice\Alexa\Request\Context\System\Device;

/**
 * Class SupportedInterfaces
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class SupportedInterfaces {
	/** @var array $AudioPlayer */
	protected $AudioPlayer;

	/** @var array $Geolocation */
	protected $Geolocation;


	/**
	 * @param array $supportedInterfacesData
	 */
	public function __construct($supportedInterfacesData) {
		if(isset($supportedInterfacesData['AudioPlayer'])) {
			$this->AudioPlayer = $supportedInterfacesData['AudioPlayer'];
		}

		if(isset($supportedInterfacesData['Geolocation'])) {
			$this->Geolocation = $supportedInterfacesData['Geolocation'];
		}
	}


	/**
	 * @return array
	 */
	public function getAudioPlayer() {
		return $this->AudioPlayer;
	}

	/**
	 * @return array
	 */
	public function getGeolocation() {
		return $this->Geolocation;
	}
}
