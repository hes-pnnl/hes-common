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
        static $instance;

        if (!$instance) {
            $instance = new static();
        }

        return $instance;
    }
}
