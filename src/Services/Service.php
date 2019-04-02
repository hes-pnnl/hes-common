<?php

namespace HESCommon\Services;

use HESCommon\Exceptions\UserSafeException;

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

    /**
     * Ensure node is installed before attempting to call command
     *
     * @throws UserSafeException
     */
    public function assertNodeIsInstalled()
    {
        exec('which node 2>&1', $output);
        if(empty($output)){
            throw new UserSafeException('Node is not installed.');
        }
    }
}
