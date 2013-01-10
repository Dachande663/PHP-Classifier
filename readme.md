Bayesian Classification Library
===============================

A Naive Bayesian classification library for PHP with
support for different tokenizers to optimize string
classification.

[![Build Status](https://travis-ci.org/Dachande663/PHP-Classifier.png)](https://travis-ci.org/Dachande663/PHP-Classifier)


0.0 Table of Contents
---------------------

* Introduction
* Examples
* Running Tests
* Troubleshooting
* Changelog


1.0 Introduction
----------------

Naive Bayesian Classification provides a computationally
cheap, but reasonably accurate method of determining which
"group" a provided string belongs to given a prior training
set.

PHP Classifier supports any number of groups to classify
strings against and uses logarithmic counting to prevent
integer underflow when using larger sets.


2.0 Examples
------------

```php

$tokenizer = new HybridLogic\Classifier\Basic;
$classifier = new HybridLogic\Classifier($tokenizer);

$classifier->train('hot', 'The sun is hot');
$classifier->train('hot', 'It was a warm day in the sun');
$classifier->train('hot', 'This tea is hot!');

$classifier->train('cold', 'This ice is very cold!');
$classifier->train('cold', 'It\'s cold at night');
$classifier->train('cold', 'Ice formed on my at over night');

$groups = $classifier->classify('It was chilly last night');
```


3.0 Running Tests
-----------------

phpunit tests


4.0 Troubleshooting
-------------------

@todo


5.0 Changelog
-------------

* **[2013-01-10]** Initial port from KoBayes
