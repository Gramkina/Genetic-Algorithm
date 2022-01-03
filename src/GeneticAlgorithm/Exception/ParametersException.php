<?php

namespace Gramk\GeneticAlgorithm\Exception;

use Exception;

class ParametersException extends Exception
{
    protected $message = 'Not all parameters have been set';
}