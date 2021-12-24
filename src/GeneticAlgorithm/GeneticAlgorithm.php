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

    }
}