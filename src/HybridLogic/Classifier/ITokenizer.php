<?php

namespace HybridLogic\Classifier;

/**
 * Tokenizer Interface
 *
 * @package default
 * @author Luke Lanchester
 **/
interface ITokenizer {


	/**
	 * Tokenize a string
	 *
	 * Given a string, return an array of features to be
	 * used for classification.
	 *
	 * @param string Input string
	 * @return array Features
	 **/
	public function tokenize($string);


} // end interface: ITokenizer