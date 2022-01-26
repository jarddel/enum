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

    /**
     *
     * @param int $value
     */
    final private function __construct(int $value, string $description = null)
    {
        $this->value = $value;
        $this->description = $description;
    }

    /**
     * Get the instance of the enumerative class
     *
     * @return EnumInterface
     */
    protected static function getInstance(int $value, string $description = null): EnumInterface
    {
        return new static($value, $description);
    }
}
