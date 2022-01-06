<?php

namespace Gramk\GeneticAlgorithm\Object;

use Gramk\GeneticAlgorithm\Exception\PopulationException;

class Population
{
    /**
     * @var Individual[] Individuals
     */
    protected array $individuals = [];

    /**
     * Generate population
     *
     * @param int $countIndividual Count individuals in population
     * @param int $countChromosomes Count chromosomes in individual
     * @param float|null $min Min value chromosome
     * @param float|null $max Max value chromosome
     *
     * @throws PopulationException
     */
    public function __construct(int $countIndividual, int $countChromosomes, float $min = null, float $max = null)
    {
        if ($min && $max) {
            for ($i = 0; $i < $countIndividual; $i++) {
                $individual = new Individual();
                $individual->autogenerateChromosomes($countChromosomes, $min, $max);
                $this->individuals[] = $individual;
            }
        } elseif (($min && !$max) || (!$min && $max)) {
            throw new PopulationException(PopulationException::THROW_RANDOM_RANGE);
        }
    }

    /**
     * Clone population
     *
     * @return void
     */
    public function __clone(): void
    {
        $this->individuals = array_map(function ($object) {
            return clone $object;
        }, $this->individuals);
    }

    /**
     * Set individuals in population
     *
     * @param array $arrayIndividuals Array of individuals
     *
     * @return bool
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