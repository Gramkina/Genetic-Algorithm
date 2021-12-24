<?php

namespace Gramk\GeneticAlgorithm\Population;

use Gramk\GeneticAlgorithm\Population\Individual;

class Population
{
    protected $population = [];

    public function __construct($countIndividual)
    {
        for ($i = 0; $i < $countIndividual; $i++) {
            $individual = new Individual(30, 1, 20);
            array_push($this->population, $individual);
        }
    }
}