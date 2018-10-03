<?php

namespace HESCommon\Exceptions;
use Exception;

/***
 * Class UserSafeException
 * Use this class for exceptions that are safe to be displayed to the user
 */
class UserSafeException extends Exception
{
    // Message must be entered (User Safe)
    public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
