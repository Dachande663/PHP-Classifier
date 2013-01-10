<?php

namespace HybridLogic;

/**
 * Bayesian Classification Library
 *
 * @package default
 * @author Luke Lanchester
 **/
class Classifier {


	/**
	 * @var array Classification subjects e.g. positive, negative
	 **/
	protected $subjects = array();


	/**
	 * @var array Tokens and their subject counts
	 **/
	protected $tokens = array();


	/**
	 * @var int Total number of rows trained with
	 **/
	protected $total_samples = 0;


	/**
	 * @var int Total number of tokens trained with
	 **/
	protected $total_tokens = 0;


	/**
	 * @var Tokenizer to extract features
	 **/
	protected $tokenizer;


	/**
	 * Constructor
	 *
	 * @param Tokenizer
	 * @return void
	 **/
	public function __construct($tokenizer) {

		if(!$tokenizer instanceof \HybridLogic\Classifier\ITokenizer) {
			throw new RuntimeException('Invalid tokenizer passed to Classifier');
		}

		$this->tokenizer = $tokenizer;

	} // end func: __construct



	/**
	 * Train this Classifier with one or more rows
	 *
	 * @param string Subject e.g. positive
	 * @param string/array One or more rows to train from
	 * @return void
	 **/
	public function train($subject, $rows) {

		if(!isset($this->subjects[$subject])) {
			$this->subjects[$subject] = array(
				'count_samples' => 0,
				'count_tokens'  => 0,
				'prior_value'   => null,
			);
		}

		if(empty($rows)) return $this;
		if(!is_array($rows)) $rows = array($rows);

		foreach($rows as $row) {

			$this->total_samples++;
			$this->subjects[$subject]['count_samples']++;

			$tokens = $this->tokenizer->tokenize($row);

			foreach($tokens as $token) {

				if(!isset($this->tokens[$token][$subject])) $this->tokens[$token][$subject] = 0;

				$this->tokens[$token][$subject]++;
				$this->subjects[$subject]['count_tokens']++;
				$this->total_tokens++;

			}

		}

	} // end func: train



	/**
	 * Classify a given string
	 *
	 * @param string Input string
	 * @return array Group probabilities
	 **/
	public function classify($string) {

		if($this->total_samples === 0) return array();

		$tokens      = $this->tokenizer->tokenize($string);
		$total_score = 0;
		$scores      = array();

		foreach($this->subjects as $subject => $subject_data) {

			$subject_data['prior_value'] = log($subject_data['count_samples'] / $this->total_samples);
			$this->subjects[$subject] = $subject_data;
			$scores[$subject] = 0;

			foreach($tokens as $token) {
				$count = isset($this->tokens[$token][$subject]) ? $this->tokens[$token][$subject] : 0;
				$scores[$subject] += log( ($count + 1) / ($subject_data['count_tokens'] + $this->total_tokens) );
			}

			$scores[$subject] = $subject_data['prior_value'] + $scores[$subject];
			$total_score += $scores[$subject];

		}

		$min = min($scores);
		$sum = 0;
		foreach($scores as $subject => $score) {
			$scores[$subject] = exp($score - $min);
			$sum += $scores[$subject];
		}

		$total = 1 / $sum;
		foreach($scores as $subject => $score) {
			$scores[$subject] = $score * $total;
		}

		arsort($scores);
		return $scores;

	} // end func: classify



} // end class: Classifier