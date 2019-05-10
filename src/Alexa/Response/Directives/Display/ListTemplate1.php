<?php

namespace InternetOfVoice\LibVoice\Alexa\Response\Directives\Display;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\ListItem;

/**
 * Class ListTemplate1
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class ListTemplate1 extends AbstractTemplate {
	/** @var string $title */
	protected $title;

	/** @var ListItem[] $listItems */
	protected $listItems = [];


	/**
	 * @param string      $token
	 * @param string      $title
	 * @param ListItem[]  $listItems
	 */
	public function __construct($token, $title, $listItems = []) {
		parent::__construct($token);

		$this->setTitle($title);
		$this->setListItems($listItems);
	}


	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param  string $title
	 *
	 * @return ListTemplate1
	 */
	public function setTitle($title) {
		$this->title = $title;

		return $this;
	}

	/**
	 * @return ListItem[]
	 */
	public function getListItems() {
		return $this->listItems;
	}

	/**
	 * @param  ListItem[] $listItems
	 *
	 * @return ListTemplate1
	 */
	public function setListItems($listItems) {
		$this->listItems = [];
		foreach($listItems as $listItem) {
			$this->addListItem($listItem);
		}

		return $this;
	}

	/**
	 * @param  ListItem $listItem
	 *
	 * @return ListTemplate1
	 */
	public function addListItem($listItem) {
		array_push($this->listItems, $listItem);

		return $this;
	}


	/**
	 * @return array
	 */
	function render() {
		$result = [
			'type'            => $this->getType(),
			'token'           => $this->getToken(),
			'backButton'      => $this->getBackButton(),
			'backgroundImage' => $this->getBackgroundImage(),
			'title'           => $this->getTitle(),
		];

		$listItems = $this->getListItems();
		if(count($listItems)) {
			$result['listItems'] = [];
			foreach($listItems as $listItem) {
				array_push($result['listItems'], $listItem->render());
			}
		}

		return $result;
	}
}
