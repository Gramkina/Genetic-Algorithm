<?php

namespace Gramk\GeneticAlgorithm\Object;

class Individual
{
    /**
     * Fitness
     */
    protected float $fitness;

    /**
     * Array of chromosomes
     *
     * @var float[]
     */
    protected array $chromosomes = [];

    /**
     * Count chromosomes
     */
    protected int $countChromosomes;

    /**
     * Create new individual
     */
    public function __construct(int $countChromosomes, bool $autoGenerate=null)
    {
        $this->countChromosomes = $countChromosomes;
        if ($autoGenerate) {
            $this->generateChromosomes();
        }
    }

    /**
     * Method for auto generate chromosomes individual
     */
    public function generateChromosomes(): bool
    {
        for ($i = 0; $i < $this->countChromosomes; $i++) {
            $chromosome = self::generateChromosome();
            $this->chromosomes[] = $chromosome;
        }
        return true;
    }

    /**
     * Set array of chromosomes
     *
     * @param $arrayChromosomes float[]
     */
    public function setChromosomes(array $arrayChromosomes): bool
    {
        $this->chromosomes = $arrayChromosomes;
        return true;
    }

    /**
     * Get individual chromosomes
     *
     * @return float[]
     */
    public function getChromosomes(): array
    {
        return $this->chromosomes;
    }

    /**
     * Set fitness
     */
    public function setFitness(float $fitness): bool
    {
        $this->fitness = $fitness;
        return true;
    }

    /**
     * Get fitness
     */
    public function getFitness(): float
    {
        return $this->fitness;
    }

    /**
     * Generate chromosome
     */
    public static function generateChromosome(): float
    {
        return rand()/getrandmax();
    }
}