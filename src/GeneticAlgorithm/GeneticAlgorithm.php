<?php

namespace Gramk\GeneticAlgorithm;

use Gramk\GeneticAlgorithm\Exception\ParametersException;
use Gramk\GeneticAlgorithm\Object\Individual;
use Gramk\GeneticAlgorithm\Object\Population;

class GeneticAlgorithm
{
    /**
     * A constant to add a pre-action to the run method
     */
    final public const PRELIMINARY_ACTION = 0;

    /**
     * A constant to add a final action to the run method
     */
    final public const FINAL_ACTION = 1;

    /**
     * Constant to add an action to main cycle genetic algorithm
     */
    final public const CYCLE_ACTION = 2;

    /**
     * @var Population $population Population in genetic algorithm
     */
    protected Population $population;

    /**
     * @var array $options Parameters in genetic algorithm
     */
    protected array $options;

    /**
     * @var callable $fitnessFunction Fitness function
     */
    protected $fitnessFunction;

    /**
     * Set parameters genetic algorithm
     *
     * @param array $options
     * @return bool
     * @throws ParametersException
     */
    public function setParameters(array $options): bool
    {
        if ($options['count_chromosomes'] &&
            $options['count_population'] &&
            $options['arguments'] &&
            $options['condition'] &&
            $options['count_mutation'] &&
            $options['generations'] &&
            $options['count_selection']) {
            $this->options = $options;
            return true;
        } else {
            throw new ParametersException(ParametersException::THROW_MAIN_PARAMETERS);
        }
    }

    /**
     * Set fitness function
     *
     * @param callable $fitnessFunction Fitness function in genetic algorithm
     * @return void
     * @throws ParametersException
     */
    public function setFitnessFunction(callable $fitnessFunction)
    {
        if (is_callable($fitnessFunction)) {
            $this->fitnessFunction = $fitnessFunction;
        } else {
            throw new ParametersException(ParametersException::THROW_FITNESS_FUNCTION);
        }
    }

    /**
     * Start method genetic algorithm
     *
     * @param null $otherAction
     * @return bool
     * @throws Exception\PopulationException
     */
    public function run($otherAction = null): bool
    {
        // Preliminary action
        if (is_callable($otherAction)) {
            $otherAction(self::PRELIMINARY_ACTION);
        }

        // Generate new population
        $this->population = new Population($this->options['count_population'], $this->options['count_chromosomes'], $this->options['min_chromosome'], $this->options['max_chromosome']);

        // Counter generation
        $currentGeneration = 0;

        if (is_callable($otherAction)) {
            while ($currentGeneration++ < $this->options['generations']) {
                $this->mainCycle();
                $otherAction(GeneticAlgorithm::CYCLE_ACTION);
            }
        } else {
            while ($currentGeneration++ < $this->options['generations']) {
                $this->mainCycle();
            }
        }

        // Final action
        if (is_callable($otherAction)) {
            $otherAction(self::FINAL_ACTION);
        }

        return true;
    }

    /**
     * Main cycle genetic algorithm
     *
     * @return void
     * @throws Exception\PopulationException
     */
    private function mainCycle(): void
    {
        $this->fitness();
        $this->population->sortByFitness();
        $this->population = $this->selection();
        $this->population = $this->mutation();
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
     *
     * @return Population
     * @throws Exception\PopulationException
     */
    private function selection(): Population
    {
        $indForSel = array_slice($this->population->getIndividuals(), 0, $this->options['count_selection']);
        $newPopulation = new Population($this->options['count_population'], $this->options['count_chromosomes']);
        $newIndividuals = [];
        for ($i = 0; $i < $this->options['count_population']; $i++) {
            $newIndividuals[$i] = new Individual();
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
     *
     * @return Population
     */
    private function mutation(): Population
    {
        $newPopulation = clone $this->population;
        for ($i = 0; $i < $this->options['count_mutation']; $i++) {
            $randomIndividual = rand(0, $this->options['count_population']-1);
            $randomChromosome = rand(0, $this->options['count_chromosomes']-1);
            $arrayChromosomes = $newPopulation->getIndividuals()[$randomIndividual]->getChromosomes();
            $arrayChromosomes[$randomChromosome] = Individual::generateChromosome($this->options['min_chromosome'], $this->options['max_chromosome']);
            $newPopulation->getIndividuals()[$randomIndividual]->setChromosomes($arrayChromosomes);
        }
        return $newPopulation;
    }
}