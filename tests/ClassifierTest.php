<?php

include './autoload.php';

/**
 * Basic Tokenizer Test
 *
 * @package default
 * @author Luke Lanchester
 **/
class ClassifierTest extends PHPUnit_Framework_TestCase {


	/**
	 * Test Classifier
	 *
	 * @return void
	 **/
	public function testClassifier() {

		$tokenizer = new HybridLogic\Classifier\Basic;
		$classifier = new HybridLogic\Classifier($tokenizer);

		$this->assertCount(0, $classifier->classify('hello world'));

		$classifier->train('hot', array(
			'The sun is hot',
			'It was a warm day in the sun',
			'This tea is hot!',
		));

		$classifier->train('cold', array(
			'This ice is very cold!',
			'It\'s cold at night',
			'Ice formed on my at over night',
		));

		$groups = $classifier->classify('it is warm');

		$expected = array(
			'hot' => 0.857142857143,
			'cold' => 0.142857142857,
		);

		$this->assertEquals($expected, $groups);

	} // end func: testClassifier



} // end class: BasicTokenizerTest