<?php

namespace InternetOfVoice\LibVoice\AlexaSmartHome\Endpoint;

use \DateTime;
use \DateTimeZone;
use \InvalidArgumentException;

/**
 * Class ReportableProperty
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 * @see     https://developer.amazon.com/docs/smarthome/state-reporting-for-a-smart-home-skill.html#property-object
 */
class ReportableProperty extends Relation {
	/** @var string $namespace */
	protected $namespace;

	/** @var string $name */
	protected $name;

	/** @var mixed $value */
	protected $value;

	/** @var DateTime $timeOfSample */
	protected $timeOfSample;

	/** @var int $uncertaintyInMilliseconds */
	protected $uncertaintyInMilliseconds;


	/**
	 * @param string    $namespace
	 * @param string    $name
	 * @param mixed     $value
	 * @param DateTime  $timeOfSample (UTC / "Zulu Time")
	 * @param int       $uncertaintyInMilliseconds
	 */
	public function __construct(string $namespace, string $name, $value, DateTime $timeOfSample = null, int $uncertaintyInMilliseconds = null) {
		$this->setNamespace($namespace);
		$this->setName($name);
		$this->setValue($value);
		$this->setTimeOfSample($timeOfSample ?: new DateTime('now', new DateTimeZone('UTC')));
		$this->setUncertaintyInMilliseconds($uncertaintyInMilliseconds ?: 0);
	}


	/**
	 * @return string
	 */
	public function getNamespace(): string {
		return $this->namespace;
	}

	/**
	 * @param  string $namespace
	 *
	 * @return ReportableProperty
	 * @throws InvalidArgumentException
	 */
	public function setNamespace(string $namespace): ReportableProperty {
		if(!$this->isInterfaceAvailable($namespace)) {
			throw new InvalidArgumentException('Unknown property namespace: ' . $namespace);
		}

		$this->namespace = $namespace;

		return $this;
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
	 * @return ReportableProperty
	 * @throws InvalidArgumentException
	 */
	public function setName(string $name): ReportableProperty {
		$properties = $this->getPropertiesFor($this->getNamespace());
		if(!array_key_exists($name, $properties)) {
			throw new InvalidArgumentException('Invalid property name: ' . $name);
		}

		$this->name = $name;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @param  mixed $value
	 *
	 * @return ReportableProperty
	 */
	public function setValue($value): ReportableProperty {
		$this->value = $value;

		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getTimeOfSample(): DateTime {
		return $this->timeOfSample;
	}

	/**
	 * @return string
	 */
	public function getTimeOfSampleAsString(): string {
		return $this->timeOfSample->format('c');
	}

	/**
	 * @param  DateTime $timeOfSample
	 *
	 * @return ReportableProperty
	 */
	public function setTimeOfSample(DateTime $timeOfSample): ReportableProperty {
        $this->timeOfSample = $timeOfSample;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getUncertaintyInMilliseconds(): int {
		return $this->uncertaintyInMilliseconds;
	}

	/**
	 * @param  int $uncertaintyInMilliseconds
	 *
	 * @return ReportableProperty
	 */
	public function setUncertaintyInMilliseconds(int $uncertaintyInMilliseconds): ReportableProperty {
		$this->uncertaintyInMilliseconds = $uncertaintyInMilliseconds;

		return $this;
	}


	/**
	 * @return array
	 */
	public function render(): array {
		$rendered = [
			'namespace'                 => $this->getNamespace(),
			'name'                      => $this->getName(),
			'timeOfSample'              => $this->getTimeOfSampleAsString(),
			'uncertaintyInMilliseconds' => $this->getUncertaintyInMilliseconds(),
		];

		$value = $this->getValue();
        if(is_object($value)) {
            $rendered['value'] = $value->render();
        } elseif(is_array($value)) {
            $values = array();
            foreach($value as $v) {
                if(is_object($v)) {
                    array_push($values, $v->render());
                } else {
                    array_push($values, $v);
                }
            }

            $rendered['value'] = $values;
        } else {
            $rendered['value'] = $value;
        }

        return $rendered;
	}
}
