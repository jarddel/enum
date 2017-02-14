<?php
namespace Robusto\Enum;

/**
 * Factory responsible for creating the enumerative classes.
 *
 * @author jarddel
 * @package Robusto\Enum
 * @copyright 2017 Robusto Enum
 */
class EnumFactory
{
    /**
     *
     * @param string $constant
     * @param string $class
     * @throws \InvalidArgumentException
     * @return Enum
     */
    public static function createEnumByConstant(string $constant, string $class): Enum
    {
        $constants = (new \ReflectionClass($class))->getConstants();
        $values = array_values($constants);
        $names = array_keys($constants);

        $index = array_search($constant, $names);

        if (false !== $index) {
            $enum = new $class();
            $enum->setValue($values[$index]);

            return $enum;
        }

        throw new \InvalidArgumentException("Invalid Value! Only enumerative values ​​of the type: {$class}");
    }
}
