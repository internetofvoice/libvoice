<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Card;

use \InvalidArgumentException;

/**
 * Class AskForPermissionsConsent
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class AskForPermissionsConsent extends AbstractCard {
	/** @var array $permissions */
	protected $permissions = [];


	/**
	 * @param array $permissions
	 */
	public function __construct($permissions) {
		parent::__construct();

		$this->type = 'AskForPermissionsConsent';
		$this->setPermissions($permissions);
	}


	/**
	 * @return array
	 */
	public function getPermissions() {
		return $this->permissions;
	}

	/**
	 * @param  array $permissions
	 *
	 * @return AskForPermissionsConsent
	 */
	public function setPermissions($permissions) {
		$this->permissions = [];
		foreach($permissions as $permission) {
			$this->addPermission(($permission));
		}

		return $this;
	}


	/**
	 * @param  string $permission
	 *
	 * @return AskForPermissionsConsent
	 * @throws InvalidArgumentException
	 */
	public function addPermission($permission) {
		if(!in_array($permission, self::CONSENT_PERMISSIONS)) {
			throw new InvalidArgumentException('Not a valid permission: ' . $permission . '.');
		}

		array_push($this->permissions, $permission);

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		return [
			'type'        => $this->getType(),
			'permissions' => $this->getPermissions(),
		];
	}
}
