<?php

namespace HESCommon\Helpers;

/**
 * Class Helper
 * Base class for Helpers. A Helper is a container class for static methods. Helpers do not have external dependencies,
 * and do not maintain state. Basically, a helper is a namespace object for functions that share a common theme.
 * If you need to maintain state or bind external dependencies, you should create a class under Services instead.
 */
abstract class Helper
{
    /**
     * The Helper constructor is private because Helper classes are strictly limited to being collections of static
     * methods. If you need to instantiate a class to support functionality, that functionality probably belongs in
     * a Service instead.
     */
    private function __construct(){}
}