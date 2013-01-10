<?php

include './autoload.php';

/**
 * Basic Tokenizer Test
 *
 * @package default
 * @author Luke Lanchester
 **/
class BasicTokenizerTest extends PHPUnit_Framework_TestCase {


	/**
	 * Test Tokenizer
	 *
	 * @param string Input string
	 * @param array Expected tokens
	 * @return void
	 * @dataProvider providerStrings
	 **/
	public function testTokenizer($string, $expected) {

		$tokenizer = new HybridLogic\Classifier\Basic;

		$tokens = $tokenizer->tokenize($string);

		$this->assertEquals($expected, $tokens);

	} // end func: testTokenizer



	/**
	 * Provider
	 *
	 * @return array Tokens
	 **/
	public function providerStrings() {
		return array(

			array(null, array()),
			array('', array()),

			array('one', array('one')),
			array(' one ', array('one')),
			array('one!', array('one')),
			array('it\'s', array('its')),

			array('The quick brown fox jumps!', array('the', 'quick', 'brown', 'fox', 'jumps')),

		);
	} // end func: providerStrings



} // end class: BasicTokenizerTest