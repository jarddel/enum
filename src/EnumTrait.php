<?php
namespace Robusto\Enum;

/**
 * Trait for enumerations.
 *
 * @author Jarddel Antunes
 * @package Robusto\Enum
 * @copyright 2017 Robusto Enum
 */
trait EnumTrait
{
    /**
     *
     * @var int Represents the value of the enumerative instance.
     */
    protected $value;

    /**
     *
     * @var string Represents the description of the enumerative instance.
     */
    protected $description;

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
     * Get description of the enumerative instance.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return (string) $this->description;
    }

    /**
     *
     * @param string $name
     * @param array $arguments
     * @return Enum
     */
    public static function __callStatic(string $name, array $arguments): EnumInterface
    {
        static::assignConstants();
        static::assignValues();

        return static::getEnumByConstant($name);
    }

    /**
     * Gets the descriptive value that represents the enumerative instance.
     *
     * @return string
     */
    public function __toString(): string
    {
        static::assignValues();
        $description = static::$descriptions[array_search($this->value, static::$values)] ?? $this->value;

        return (string) $description;
    }

    /**
     * Get the instance of the enumerative class
     *
     * @param int $value
     * @param string $description
     * @return EnumInterface
     */
    abstract protected static function getInstance(int $value, string $description = null): EnumInterface;

    /**
     * Get the instance of the enumerative class by constant
     *
     * @param string $constant
     * @throws \InvalidArgumentException
     * @return EnumInterface
     */
    protected static function getEnumByConstant(string $constant): EnumInterface
    {
        static::assignConstants();
        static::assignValues();

        try {
            return static::getEnumByValue($constant, static::$constants);
        } catch(\InvalidArgumentException $exception) {
            throw $exception;
        }
    }

    /**
     * Get the instance of the enumerative class by description
     *
     * @param string $constant
     * @throws \InvalidArgumentException
     * @return EnumInterface
     */
    protected static function getEnumByDescription(string $constant): EnumInterface
    {
        static::assignValues();

        try {
            return self::getEnumByValue($constant, static::$descriptions);
        } catch(\InvalidArgumentException $exception) {
            throw $exception;
        }
    }

    /**
     * Get the instance of the enumerative class by value, if it's in values.
     *
     * @param string $value
     * @param array $values
     * @throws \InvalidArgumentException
     * @return EnumInterface
     */
    protected static function getEnumByValue(string $value, array $values): EnumInterface
    {
        $index = array_search($value, $values);

        if (false !== $index) {
            $description = static::$descriptions[array_search(static::$values[$index], static::$values)] ?? '';
            $enum = static::getInstance(static::$values[$index], $description);

            return $enum;
        }

        throw new \InvalidArgumentException("Invalid Value! Only enumerative values ​​of the type:". static::class);
    }

    /**
     * Assigns the possible values ​​according to the enumerative class.
     */
    protected static function assignValues()
    {
        static::$values = array_values((new \ReflectionClass(static::class))->getConstants());
    }

    /**
    * Assigns the constants of the enumerative class.
    */
    protected static function assignConstants()
    {
        static::$constants = array_keys((new \ReflectionClass(static::class))->getConstants());
    }
}
