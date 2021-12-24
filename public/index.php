<?php

require __DIR__.'/../vendor/autoload.php';

use Gramk\GeneticAlgorithm\GeneticAlgorithm;

// Решить уравнение 5x+4y+6z=100

$dd = new GeneticAlgorithm(10, 3);
$dd->setParameters([
    'count_population' => 10,
    'count_chromosomes' => 3,
    'arguments' => [4, 5, 6],
    'condition' => 3,
    'count_selection' => 4,
]);
print_r($dd->run());