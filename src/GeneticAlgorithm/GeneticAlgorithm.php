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
    protected $population;

    /**
     * Parameters
     *
     * @var array
     */
    protected $options;

    /**
     * Set parameters genetic algorithm
     *
     * @param $options array
     * @throws \Exception
     */
    public function setParameters($options)
    {
        if ($options['count_chromosomes'] && $options['count_population'] && $options['arguments'] && $options['condition'] && $options['count_selection']) {
            $this->options = $options;
        } else {
            throw new \Exception();
        }

    }

    /**
     * Start genetic algorithm
     */
    public function run()
    {
        // Generate new population
        $this->population = new Population($this->options['count_population'], $this->options['count_chromosomes']);

        $this->fitness($this->population);
        $this->population->sortByFitness();
        return $this->population->getIndividuals();

    }

    /**
     * Check chromosomes on condition
     *
     * @param $population Population
     */
    private function fitness($population)
    {
        $coff = 0;
        foreach ($this->population->getIndividuals() as $individual) {
            $sum = 0;
            for ($i = 0; $i < $this->options['count_chromosomes']; $i++) {
                $sum += $individual->getChromosomes()[$i] * $this->options['arguments'][$i];
            }
            $individual->setFitness($sum);
            $coff += $sum;
        }
        foreach ($this->population->getIndividuals() as $individual) {
            $individual->setFitness($individual->getFitness()/$coff);
        }
    }

    private function selection()
    {

    }
}