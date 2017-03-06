<?php

namespace AppBundle\Enum;

/**
 * Class BaseEnum.
 */
abstract class BaseEnum
{
    private static $constantArray = null;
    /**
     * Get all the constant of the enum
     * Array returned is formated : [constantName => constantValue].
     *
     * @return array
     */
    final public static function getConstants()
    {
        if (self::$constantArray == null) {
            self::$constantArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constantArray)) {
            $reflect                           = new \ReflectionClass($calledClass);
            self::$constantArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constantArray[$calledClass];
    }
    /**
     * Get all the constant values of the enum.
     *
     * @return array
     */
    final public static function getConstantValues()
    {
        return array_values(self::getConstants());
    }
    /**
     * @param $value
     *
     * @return bool
     */
    final public static function isValidValue($value)
    {
        return in_array($value, self::getConstantValues());
    }
    /**
     * @param $prefixLabel
     *
     * @return array
     */
    final public static function getFormChoices($prefixLabel)
    {
        $choices   = [];
        $constants = self::getConstants();
        foreach ($constants as $constant) {
            $choices[$constant] = sprintf(
                '%s.%s',
                $prefixLabel,
                strtolower($constant)
            );
        }
        return $choices;
    }
}