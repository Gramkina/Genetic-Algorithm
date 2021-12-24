<?php

namespace Gramk\GeneticAlgorithm;

use Gramk\GeneticAlgorithm\Object\Population;

class GeneticAlgorithm
{
    /**
     * Population
     *
     * @var Population
     */
    private $population;

    /**
     * Count individual chromosomes
     *
     * @var int
     */
    private $countIndividualChromosomes;

    /**
     * Count population individual
     *
     * @var int
     */
    private $countPopulationIndividual;

    /**
     * GeneticAlgorithm constructor.
     * @param $countPopulationIndividual int
     * @param $countIndividualChromosomes int
     */
    public function __construct($countPopulationIndividual, $countIndividualChromosomes)
    {
        $this->population = new Population($countPopulationIndividual, $countIndividualChromosomes);
    }

    public function setParameters()
    {

    }

    /**
     * Start genetic algorithm
     */
    public function run()
    {

    }
}