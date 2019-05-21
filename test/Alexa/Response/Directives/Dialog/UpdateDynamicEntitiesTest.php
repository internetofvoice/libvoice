<?php

namespace Tests\Alexa\Response\Directives\Dialog;

use \InternetOfVoice\LibVoice\Alexa\Response\Directives\Dialog\UpdateDynamicEntities;
use \InternetOfVoice\LibVoice\Alexa\Response\Slot\Type;
use \InternetOfVoice\LibVoice\Alexa\Response\Slot\Value;
use \InvalidArgumentException;
use \PHPUnit\Framework\TestCase;

/**
 * Class UpdateDynamicEntitiesTest
 *
 * @author  Alexander Schmidt <a.schmidt@internet-of-voice.de>
 * @license http://opensource.org/licenses/MIT
 */
class UpdateDynamicEntitiesTest extends TestCase {
	/**
	 * @group custom-skill
	 */
	public function testUpdateDynamicEntities() {
		$value2 = new Value('myID2', 'myValue2');
		$value1 = new Value('myID1', 'myValue1');
		$value1->setSynonyms(['mySynonym1', 'mySynonym2']);

		$type1 = new Type('myType1');
		$type1->setValues([$value1]);
		$type1->addValue($value2);

		$type2 = new Type('myType2');
		$type2->addValue($value2);

		$dialog = new UpdateDynamicEntities('REPLACE');
		$dialog->setTypes([$type1])->addType($type2);

		$expect = [
			'type' => 'Dialog.UpdateDynamicEntities',
			'updateBehavior' => 'REPLACE',
			'types' => [
				[
					'name' => 'myType1',
					'values' => [
						[
							'id' => 'myID1',
							'name' => [
								'value' => 'myValue1',
								'synonyms' => ['mySynonym1', 'mySynonym2'],
							],
						],
						[
							'id' => 'myID2',
							'name' => [
								'value' => 'myValue2',
							],
						],
					],
				],
				[
					'name' => 'myType2',
					'values' => [
						[
							'id' => 'myID2',
							'name' => [
								'value' => 'myValue2',
							],
						],
					],
				],
			],
		];

		$this->assertEquals($expect, $dialog->render());

		$this->expectException(InvalidArgumentException::class);
		$dialog->setUpdateBehavior('NONSENSE-BEHAVIOR');
	}
}
