<?php

namespace Gramk\GeneticAlgorithm\Object;

class Population
{
    /**
     * Individuals
     *
     * @var Individual[]
     */
    protected array $individuals = [];

    /**
     * Count of individual
     */
    protected int $countIndividual;

    /**
     * Generate population
     */
    public function __construct(int $countIndividual, int $countChromosomes, bool $autoGenerate=null)
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
     */
    public function setIndividuals(array $arrayIndividuals): bool
    {
        $this->individuals = $arrayIndividuals;
        return true;
    }

    /**
     * Get individuals
     *
     * @return array Individual
     */
    public function getIndividuals(): array
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
            if ($a->getFitness() == $b->getFitness()) {
                return 0;
            }
            return ($a->getFitness() < $b->getFitness()) ? -1 : 1;
        });
    }

}