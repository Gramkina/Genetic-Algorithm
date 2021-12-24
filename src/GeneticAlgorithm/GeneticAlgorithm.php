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
        if ($options['count_chromosomes'] && $options['count_population'] && $options['arguments'] && $options['condition']) {
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

        // Check chromosomes
        if ($this->checkChromosomes($this->population)) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Check chromosomes on condition
     *
     * @param $population Population
     * @return float|int
     */
    private function checkChromosomes($population)
    {
        foreach ($this->population->getIndividuals() as $individual) {
            $sum = 0;
            for ($i = 0; $i < $this->options['count_chromosomes']; $i++) {
                $sum += $individual->getChromosomes()[$i]*$this->options['arguments'][$i];
            }
            return $sum > $this->options['condition']-1 && $sum < $this->options['condition']+1;

        }
    }
}