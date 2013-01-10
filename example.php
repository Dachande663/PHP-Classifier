<?php echo '<pre>';

include './autoload.php';


$tokenizer = new HybridLogic\Classifier\Basic;
$classifier = new HybridLogic\Classifier($tokenizer);


$classifier->train('hot', 'The sun is hot');
$classifier->train('hot', 'It was a warm day in the sun');
$classifier->train('hot', 'This tea is hot!');

$classifier->train('cold', 'This ice is very cold!');
$classifier->train('cold', 'It\'s cold at night');
$classifier->train('cold', 'Ice formed on my at over night');


$groups = $classifier->classify('It was chilly last night');
var_dump($groups);