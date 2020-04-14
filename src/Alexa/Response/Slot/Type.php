<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Slot;

/**
 * Class Type
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class Type {
	/** @var string $name */
	protected $name;

	/** @var Value[] $values */
	protected $values = [];


	/**
	 * @param string $name
	 */
	public function __construct(string $name) {
		$this->setName($name);
	}


	/**
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * @param  string $name
	 *
	 * @return Type
	 */
	public function setName(string $name): Type {
		$this->name = $name;

		return $this;
	}

	/**
	 * @return Value[]
	 */
	public function getValues(): array {
		return $this->values;
	}

	/**
	 * @param  Value[] $values
	 *
	 * @return Type
	 */
	public function setValues(array $values): Type {
		$this->values = [];
		foreach($values as $value) {
			$this->addValue($value);
		}

		return $this;
	}

	/**
	 * @param  Value $value
	 *
	 * @return Type
	 */
	public function addValue(Value $value): Type {
		array_push($this->values, $value);

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		$result = [
			'name'   => $this->getName(),
			'values' => [],
		];

		$values = $this->getValues();
		foreach($values as $value) {
			array_push($result['values'], $value->render());
		}

		return $result;
	}
}
