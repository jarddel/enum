<?php
namespace Robusto\Enum;

/**
 * Abstract class for enumerations, which can be used along with DBAL (Database Abstraction Layer)
 * To work on the concept of types.
 *
 * @author jarddel
 * @package Robusto\Enum
 * @copyright 2017 Robusto Enum
 */
abstract class EnumType extends Enum
{
    /**
     *
     * @param array $fieldDeclaration
     * @param object $platform
     * @return string
     */
    public function getSQLDeclaration($fieldDeclaration, $platform)
    {
        static::assignValues();

        $values = implode(', ', static::$values);

        return "ENUM('{$values}')";
    }

    /**
     *
     * @param mixed $value
     * @param object $platform
     * @return Enum
     */
    public function convertToPHPValue($value, $platform)
    {
        return EnumFactory::createEnumByConstant($value, static::class);
    }

    /**
     *
     * @return boolean
     */
    public function canRequireSQLConversion()
    {
        return false;
    }
}
