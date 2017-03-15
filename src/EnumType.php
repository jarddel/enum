<?php
namespace Robusto\Enum;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Abstract class for enumerations, which can be used along with DBAL (Database Abstraction Layer)
 * To work on the concept of types.
 *
 * @author Jarddel Antunes
 * @package Robusto\Enum
 * @copyright 2017 Robusto Enum
 */
abstract class EnumType extends Type implements EnumInterface
{
    use EnumTrait;

    /**
     *
     * {@inheritDoc}
     * @see \Doctrine\DBAL\Types\Type::getSQLDeclaration()
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        static::assignValues();

        return "ENUM(".implode(", ", static::$descriptions ? : static::$values).")";
    }

    /**
     *
     * {@inheritDoc}
     * @see \Doctrine\DBAL\Types\Type::convertToPHPValue()
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return static::getEnumByDescription($value);
    }

    /**
     *
     * {@inheritDoc}
     * @see \Doctrine\DBAL\Types\Type::getName()
     */
    public function getName()
    {
        return static::class;
    }

    /**
     * Get the instance of the enumerative class
     *
     * @return EnumInterface
     */
    protected static function getInstance(): EnumInterface
    {
        $type = strtolower(preg_replace(['(.*[\\\/])','/Enum|Type/','/(?<!^)[A-Z]/'], ['','','_$0'], static::class));

        return clone static::getType($type);
    }

    /**
     * Assigns the possible values ​​according to the enumerative class.
     */
    protected static function assignValues()
    {
        $valuesSubClass = array_values((new \ReflectionClass(static::class))->getConstants());
        $valuesSelfClass = array_values((new \ReflectionClass(self::class))->getConstants());

        static::$values = array_diff($valuesSubClass, $valuesSelfClass);
    }

    /**
     * Assigns the constants of the enumerative class.
     */
    protected static function assignConstants()
    {
        $constantsSubClass = array_keys((new \ReflectionClass(static::class))->getConstants());
        $constantsSelfClass = array_keys((new \ReflectionClass(self::class))->getConstants());

        static::$constants = array_diff($constantsSubClass, $constantsSelfClass);
    }
}
