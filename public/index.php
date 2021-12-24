<?php

require __DIR__.'/../vendor/autoload.php';

use Gramk\GeneticAlgorithm\GeneticAlgorithm;

// Решить уравнение 5x+4y+6z=100

$dd = new GeneticAlgorithm(10, 3);
$dd->run();