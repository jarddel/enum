<?php
namespace Robusto\Enum;

/**
 * Abstract class for enumerations.
 *
 * @author jarddel
 * @package Robusto\Enum
 * @copyright 2017 Robusto Enum
 */
abstract class Enum
{
    /**
     *
     * @var int Represents the value of the enumerative instance.
     */
    protected $value;

    /**
     *
     * @var array Represents possible values ​​according to the enumerative class.
     */
    protected static $values = [];

    /**
     *
     * @var array Represents the possible descriptive values ​​according to the enumerative class.
     */
    protected static $descriptions = [];

    /**
     *
     * @var array Represents the names of the constants of the enumerative class.
     */
    protected static $constants = [];


    final function __construct()
    {
        static::assignConstants();
        static::assignValues();
    }

    /**
     * Gets all possible values ​​for the enumerative class.
     *
     * @return array
     */
    public static function getValues(): array
    {
        static::assignValues();

        return static::$values;
    }

    /**
     * Gets all possible descriptions for the enumerative class.
     *
     * @return array
     */
    public static function getDescriptions(): array
    {
        static::assignValues();

        return static::$descriptions;
    }

    /**
     * Get value of the enumerative instance.
     *
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * Set value of the enumerative instance.
     *
     * @param int $value
     */
    public function setValue(int $value)
    {
        $this->value = $value;
    }

    /**
     *
     * @param string $name
     * @param array $arguments
     * @return Enum
     */
    public static function __callStatic(string $name, array $arguments): Enum
    {
        return EnumFactory::createEnumByConstant($name, static::class);
    }

    /**
     * Gets the descriptive value that represents the enumerative instance.
     *
     * @return string
     */
    public function __toString()
    {
        $description = static::$descriptions[array_search($this->value, static::$values)] ?? $this->value;

        return (string) $description;
    }

    /**
     * Assigns the possible values ​​according to the enumerative class.
     */
    private static function assignValues()
    {
        static::$values = array_values((new \ReflectionClass(static::class))->getConstants());
    }

    /**
    * Assigns the constants of the enumerative class.
    */
    private static function assignConstants()
    {
        static::$constants = array_keys((new \ReflectionClass(static::class))->getConstants());
    }
}
