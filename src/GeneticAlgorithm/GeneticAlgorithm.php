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
        if ($options['count_chromosomes'] &&
            $options['count_population'] &&
            $options['arguments'] &&
            $options['condition'] &&
            $options['count_mutation'] &&
            $options['generations'] &&
            $options['count_selection']) {
            $this->options = $options;
        } else {
            throw new Exception();
        }

    }

    /**
     * Start genetic algorithm
     */
    public function run(): float
    {
        // Generate new population
        $this->population = new Population($this->options['count_population'], $this->options['count_chromosomes'], true);

        // Counter generation
        $currentGeneration = 0;

        // Main cycle
        while ($currentGeneration++ < $this->options['generations']) {
            $this->fitness();
            $this->population->sortByFitness();
            $this->population = $this->selection();
            $this->population = $this->mutation();
        }

        // Result
        $this->fitness();
        $this->population->sortByFitness();
        $chromosomes = $this->population->getIndividuals()[0]->getChromosomes();
        $result = 0;
        for ($i = 0; $i < $this->options['count_chromosomes']; $i++) {
            $result += $chromosomes[$i] * $this->options['arguments'][$i];
        }
        return $result;
    }

    /**
     * Check chromosomes on condition
     */
    private function fitness(): void
    {
        $coff = 0;
        foreach ($this->population->getIndividuals() as $individual) {
            $sum = 0;
            for ($i = 0; $i < $this->options['count_chromosomes']; $i++) {
                $sum += $individual->getChromosomes()[$i] * $this->options['arguments'][$i];
            }
            $sum = abs($sum - $this->options['condition']);
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
    private function selection(): Population
    {
        $indForSel = array_slice($this->population->getIndividuals(), 0, $this->options['count_selection']);
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
        return $newPopulation;
    }

    /**
     * Mutation
     */
    private function mutation(): Population
    {
        $newPopulation = unserialize(serialize($this->population));
        for ($i = 0; $i < $this->options['count_mutation']; $i++) {
            $randomIndividual = rand(0, $this->options['count_population']-1);
            $randomChromosome = rand(0, $this->options['count_chromosomes']-1);
            $arrayChromosomes = $newPopulation->getIndividuals()[$randomIndividual]->getChromosomes();
            $arrayChromosomes[$randomChromosome] = Individual::generateChromosome();
            $newPopulation->getIndividuals()[$randomIndividual]->setChromosomes($arrayChromosomes);
        }
        return $newPopulation;
    }
}