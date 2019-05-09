<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\Dialog;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\AbstractDirective;
use \InternetOfVoice\LibVoice\Alexa\Response\Slot\Type;
use \InvalidArgumentException;

/**
 * Class UpdateDynamicEntities
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class UpdateDynamicEntities extends AbstractDirective{
	const UPDATE_BEHAVIORS = ['REPLACE', 'CLEAR'];

	/** @var string $updateBehavior */
	protected $updateBehavior;

	/** @var Type[] $types */
	protected $types;


	public function __construct($updateBehavior) {
		parent::__construct();

		$this->type = 'Dialog.UpdateDynamicEntities';
		$this->setUpdateBehavior($updateBehavior);
	}

	/**
	 * @return string
	 */
	public function getUpdateBehavior() {
		return $this->updateBehavior;
	}

	/**
	 * @param  string $updateBehavior
	 *
	 * @return UpdateDynamicEntities
	 * @throws InvalidArgumentException
	 */
	public function setUpdateBehavior($updateBehavior) {
		if(!in_array($updateBehavior, self::UPDATE_BEHAVIORS)) {
			throw new InvalidArgumentException('UpdateBehavior must be one of ' . implode(', ', self::UPDATE_BEHAVIORS));
		}

		$this->updateBehavior = $updateBehavior;

		return $this;
	}

	/**
	 * @return Type[]
	 */
	public function getTypes() {
		return $this->types;
	}

	/**
	 * @param  Type[] $types
	 *
	 * @return UpdateDynamicEntities
	 */
	public function setTypes($types) {
		$this->types = [];
		foreach($types as $type) {
			$this->addType($type);
		}

		return $this;
	}

	/**
	 * @param  Type $type
	 *
	 * @return UpdateDynamicEntities
	 */
	public function addType($type) {
		array_push($this->types, $type);

		return $this;
	}


	/**
	 * @return array
	 */
	public function render() {
		$result = [
			'type'           => $this->getType(),
			'updateBehavior' => $this->getUpdateBehavior(),
		];

		$types = $this->getTypes();
		if(count($types)) {
			$result['types'] = [];
			foreach($types as $type) {
				array_push($result['types'], $type->render());
			}
		}

		return $result;
	}
}
