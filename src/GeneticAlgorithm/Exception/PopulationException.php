<?php

namespace Gramk\GeneticAlgorithm\Exception;

use Exception;
use Throwable;

class PopulationException extends Exception
{
    const THROW_RANDOM_RANGE = 0;

    public function __construct($type, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        switch ($type) {
            case self::THROW_RANDOM_RANGE:
                $message = 'The range of values for the generation of chromosomes is not specified';
                break;
        }
        parent::__construct($message, $code, $previous);
    }
}
