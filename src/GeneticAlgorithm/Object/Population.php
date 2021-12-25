<?php

namespace Gramk\GeneticAlgorithm\Object;

class Population
{
    /**
     * Individuals
     *
     * @var Individual[]
     */
    protected $individuals = [];

    /**
     * Count of individual
     *
     * @var int
     */
    protected $countIndividual;

    /**
     * Count individual chromosomes
     *
     * @var int
     */
    protected $countChromosomes;

    /**
     * @param $countIndividual int
     * @param $countChromosomes int
     * @param $autoGenerate bool
     */
    public function __construct($countIndividual, $countChromosomes, $autoGenerate=null)
    {
        $this->countIndividual = $countIndividual;
        if ($autoGenerate) {
            for ($i = 0; $i < $countIndividual; $i++) {
                $individual = new Individual($countChromosomes, true);
                $this->individuals[] = $individual;
            }
        }
    }

    /**
     * Set individuals in population
     *
     * @param $arrayIndividuals Individual[]
     * @return bool
     */
    public function setIndividuals($arrayIndividuals) {
        $this->individuals = $arrayIndividuals;
        return true;
    }

    /**
     * Get individuals
     *
     * @return array Individual
     */
    public function getIndividuals()
    {
        return $this->individuals;
    }

    /**
     * Sort individuals by fitness
     *
     * @return void
     */
    public function sortByFitness()
    {
        usort($this->individuals, function ($a, $b) {
            if ($a->fitness == $b->fitness) {
                return 0;
            }
            return ($a->fitness < $b->fitness) ? -1 : 1;
        });
    }

}