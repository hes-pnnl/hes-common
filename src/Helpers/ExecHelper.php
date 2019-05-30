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
        self::assertIsInstalled('node');
    }
    
    /**
     * Ensure git is installed before attempting to call command
     *
     * @throws UserSafeException
     */
    public static function assertGitIsInstalled()
    {
        self::assertIsInstalled('git');
    }
    
    /**
     * Ensure given command tool is installed before attempting to call command
     *
     * @throws UserSafeException
     */
    public static function assertIsInstalled($command)
    {
        exec("which $command 2>&1", $output);
        if(empty($output)){
            throw new UserSafeException("$command is not installed.");
        }
    }
}
