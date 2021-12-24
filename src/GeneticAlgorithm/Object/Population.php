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