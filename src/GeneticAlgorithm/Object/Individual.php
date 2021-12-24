<?php

namespace Gramk\GeneticAlgorithm\Object;

class Individual
{
    protected $chromosomes = [];

    /**
     * Create new individual
     * @param $countChromosomes int
     * @param $minValue int
     * @param $maxValue int
     */
    public function __construct($countChromosomes)
    {
        for ($i = 0; $i < $countChromosomes; $i++) {
            $chromosome = rand()/getrandmax();
            array_push($this->chromosomes, $chromosome);
        }
    }

    public function getChromosomes()
    {
        return $this->chromosomes;
    }
}