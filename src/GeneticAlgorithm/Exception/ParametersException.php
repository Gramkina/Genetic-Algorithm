<?php

namespace Gramk\GeneticAlgorithm\Exception;

use Exception;
use Throwable;

class ParametersException extends Exception
{
    /**
     * Exception when fitness function is not specified
     */
    final public const THROW_FITNESS_FUNCTION = 0;

    /**
     * Exception when one of the main parameters was not specified
     */
    final public const THROW_MAIN_PARAMETERS = 1;

    /**
     * @param int $type Type exception
     * @param string $message Message exception
     * @param int $code Code exception
     * @param Throwable|null $previous
     */
    public function __construct(int $type, string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        switch ($type) {
            case self::THROW_FITNESS_FUNCTION:
                $message = 'The fitness function was set incorrectly';
                break;
            case self::THROW_MAIN_PARAMETERS:
                $message = 'Not all parameters have been set';
                break;
        }
        parent::__construct($message, $code, $previous);
    }
}