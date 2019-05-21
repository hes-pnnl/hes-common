<?php

namespace HESCommon\Helpers;

use HESCommon\Exceptions\UserSafeException;

class ExecHelper
{
    /**
     * Ensure node is installed before attempting to call command
     *
     * @throws UserSafeException
     */
    public static function assertNodeIsInstalled()
    {
        exec('which node 2>&1', $output);
        if(empty($output)){
            throw new UserSafeException('Node is not installed.');
        }
    }
}
