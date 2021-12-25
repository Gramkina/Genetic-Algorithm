<?php

namespace Gramk\GeneticAlgorithm;

use Exception;
use Gramk\GeneticAlgorithm\Object\Individual;
use Gramk\GeneticAlgorithm\Object\Population;

class GeneticAlgorithm
{
    /**
     * Population
     */
    protected Population $population;

    /**
     * Parameters
     */
    protected array $options;

    /**
     * Set parameters genetic algorithm
     *
     * @throws Exception
     */
    public function setParameters(array $options)
    {
        if ($options['count_chromosomes'] && $options['count_population'] && $options['arguments'] && $options['condition'] && $options['count_mutation']) {
            $this->options = $options;
        } else {
            throw new Exception();
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
        $this->selection();
        $this->mutation();

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

    /**
     * Selection
     */
    private function selection()
    {
        $indForSel = array_slice($this->population->getIndividuals(), 0, $this->options['count_population']);
        $newPopulation = new Population($this->options['count_population'], $this->options['count_chromosomes']);
        $newIndividuals = [];
        for ($i = 0; $i < $this->options['count_population']; $i++) {
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
        $this->population = $newPopulation;
    }

    /**
     * Mutation
     */
    private function mutation(): bool
    {
        for ($i = 0; $i < $this->options['count_mutation']; $i++) {
            $randomIndividual = rand(0, $this->options['count_population']-1);
            $randomChromosome = rand(0, $this->options['count_chromosomes']-1);
            $arrayChromosomes = $this->population->getIndividuals()[$randomIndividual]->getChromosomes();
            $arrayChromosomes[$randomChromosome] = Individual::generateChromosome();
            $this->population->getIndividuals()[$randomIndividual]->setChromosomes($arrayChromosomes);
        }
        return true;
    }
}