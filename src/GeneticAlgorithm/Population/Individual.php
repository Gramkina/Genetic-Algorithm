<?php

namespace Gramk\GeneticAlgorithm\Population;

class Individual
{
    protected $chromosomes = [];

    /**
     * Create new individual
     * @param $countChromosomes int
     * @param $minValue int
     * @param $maxValue int
     */
    public function __construct($countChromosomes, $minValue, $maxValue)
    {
        for ($i = 0; $i < $countChromosomes; $i++) {
            $chromosome = rand($minValue, $maxValue);
            array_push($this->chromosomes, $chromosome);
        }
    }
}