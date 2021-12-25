<?php

namespace Gramk\GeneticAlgorithm;

use Gramk\GeneticAlgorithm\Object\Individual;
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
        $this->population = new Population($this->options['count_population'], $this->options['count_chromosomes'], true);

        $this->fitness();
        $this->population->sortByFitness();
        return $this->selection();

    }

    /**
     * Check chromosomes on condition
     *
     * @return void
     */
    private function fitness()
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
        $indForSel = array_slice($this->population->getIndividuals(), 0, $this->options['count_selection']);
        $newPopulation = new Population($this->options['count_population'], $this->options['count_chromosomes']);
        $newIndividuals = [];
        for ($i = 0; $i < $this->options['count_selection']; $i++) {
            $newIndividuals[$i] = new Individual($this->options['count_chromosomes']);
            $parentIndividual = array_rand($indForSel, 2);
            $countFirstChromosomes = rand(1, $this->options['count_chromosomes']-1);
            $arrayChromosomes = [];
            for ($j = 0; $j < $this->options['count_chromosomes']; $j++) {
                $arrayChromosomes[] = $indForSel[$parentIndividual[($j < $countFirstChromosomes ? 0 : 1)]]->getChromosomes()[$j];
            }
            $newIndividuals[$i]->setChromosomes($arrayChromosomes);
        }
        $newPopulation->setIndividuals($newIndividuals);
    }
}