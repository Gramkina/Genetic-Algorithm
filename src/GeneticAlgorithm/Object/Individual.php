<?php

namespace Gramk\GeneticAlgorithm\Object;

class Individual
{
    /**
     * Fitness
     *
     * @var int
     */
    public $fitness;

    protected $chromosomes = [];

    /**
     * Create new individual
     * @param $countChromosomes int
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

    /**
     * Set fitness
     *
     * @param $fitness float
     * @return void
     */
    public function setFitness($fitness)
    {
        $this->fitness = $fitness;
    }

    public function getFitness()
    {
        return $this->fitness;
    }
}