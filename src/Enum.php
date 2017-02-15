<?php
namespace Robusto\Enum;

/**
 * Abstract class for enumerations.
 *
 * @author Jarddel Antunes
 * @package Robusto\Enum
 * @copyright 2017 Robusto Enum
 */
abstract class Enum implements EnumInterface
{
    use EnumTrait;

    final private function __construct(){}

    /**
     * Get the instance of the enumerative class
     *
     * @return EnumInterface
     */
    protected function getInstance(): EnumInterface
    {
        return new static();
    }
}
