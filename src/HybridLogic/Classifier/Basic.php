<?php

namespace HybridLogic\Classifier;

/**
 * Basic tokenizer
 *
 * @package default
 * @author Luke Lanchester
 **/
class Basic implements \HybridLogic\Classifier\ITokenizer {


	/**
	 * Tokenize a string
	 *
	 * Given a string, return an array of features to be
	 * used for classification.
	 *
	 * @param string Input string
	 * @return array Features
	 **/
	public function tokenize($string) {

		$string = strtolower($string);
		$string = preg_replace('/[^a-z0-9 ]/', '', $string);

		$count = preg_match_all('/\w+/', $string, $matches);

		return $count ? $matches[0] : array();

	} // end func: tokenize



} // end class: Basic