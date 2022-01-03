<?php

namespace Gramk\GeneticAlgorithm\Object;

class Individual
{
    /**
     * @var float Fitness
     */
    protected float $fitness;

    /**
     * @var float[] Array of chromosomes
     */
    protected array $chromosomes = [];

    /**
     * Autogenerate chromosomes
     *
     * @param int $countChromosomes Count of chromosomes in one individual
     * @param float $min Min value chromosome
     * @param float $max Max value chromosome
     *
     * @return void
     */
    public function autogenerateChromosomes(int $countChromosomes, float $min, float $max)
    {
        for ($i = 0; $i < $countChromosomes; $i++) {
            $chromosome = self::generateChromosome($min, $max);
            $this->chromosomes[] = $chromosome;
        }
    }

    /**
     * Set array of chromosomes
     *
     * @param float[] $arrayChromosomes Array containing chromosomes
     *
     * @return bool
     */
    public function setChromosomes(array $arrayChromosomes): bool
    {
        $this->chromosomes = $arrayChromosomes;
        return true;
    }

    /**
     * Get individual chromosomes
     *
     * @return float[] Array of chromosomes
     */
    public function getChromosomes(): array
    {
        return $this->chromosomes;
    }

    /**
     * Set fitness
     *
     * @param float $fitness Fitness value
     *
     * @return bool
     */
    public function setFitness(float $fitness): bool
    {
        $this->fitness = $fitness;
        return true;
    }

    /**
     * Get fitness
     *
     * @return float Return fitness value
     */
    public function getFitness(): float
    {
        return $this->fitness;
    }

    /**
     * Generate chromosome
     *
     * @param float $min Min value chromosome
     * @param float $max Max value chromosome
     *
     * @return float Return generated chromosome
     */
    public static function generateChromosome(float $min, float $max): float
    {
        return rand($min, $max-1)+rand()/getrandmax();
    }
}