<?php

namespace Gramk\GeneticAlgorithm\Object;

class Individual
{
    /**
     * Fitness
     *
     * @var int
     */
    protected $fitness;

    /**
     * Array of chromosomes
     *
     * @var float[]
     */
    protected $chromosomes = [];

    /**
     * Count chromosomes
     *
     * @var int
     */
    protected $countChromosomes;

    /**
     * Create new individual
     *
     * @param $autoGenerate bool
     * @param $countChromosomes int
     */
    public function __construct($countChromosomes, $autoGenerate=null)
    {
        $this->countChromosomes = $countChromosomes;
        if ($autoGenerate) {
            $this->generateChromosomes();
        }
    }

    /**
     * Method for auto generate chromosomes individual
     *
     * @return bool
     */
    public function generateChromosomes()
    {
        for ($i = 0; $i < $this->countChromosomes; $i++) {
            $chromosome = rand()/getrandmax();
            $this->chromosomes[] = $chromosome;
        }
        return true;
    }

    /**
     * Set array of chromosomes
     *
     * @param $arrayChromosomes float[]
     * @return bool
     */
    public function setChromosomes($arrayChromosomes)
    {
        $this->chromosomes = $arrayChromosomes;
        return true;
    }

    /**
     * Get individual chromosomes
     *
     * @return float[]
     */
    public function getChromosomes()
    {
        return $this->chromosomes;
    }

    /**
     * Set fitness
     *
     * @param $fitness float
     * @return bool
     */
    public function setFitness($fitness)
    {
        $this->fitness = $fitness;
        return true;
    }

    /**
     * Get fitness
     *
     * @return float
     */
    public function getFitness()
    {
        return $this->fitness;
    }
}