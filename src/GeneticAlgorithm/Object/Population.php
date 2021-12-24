<?php

namespace Gramk\GeneticAlgorithm\Object;

class Population
{
    /**
     * @var array Individual
     */
    protected $individuals = [];

    public function __construct($countIndividual, $countChromosomes)
    {
        for ($i = 0; $i < $countIndividual; $i++) {
            $individual = new Individual($countChromosomes);
            array_push($this->individuals, $individual);
        }
    }
}