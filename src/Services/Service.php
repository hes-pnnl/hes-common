<?php

namespace HESCommon\Services;

/**
 * Class Service
 *
 * Base class for all Services. Services are singleton utility classes that are intended to be injected into other
 * classes.
 */
abstract class Service
{
    protected function __construct() {}

    /**
     * @return static
     */
    public static function getInstance() {
         static $instances = [];

        // Dynamically get the name of the child class executing this method
        $className = static::class;

        if (!isset($instances[$className])) {
            $instances[$className] = new static();
        }

        return $instances[$className];
    }
}
