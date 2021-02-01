<?php

namespace HESCommon\Helpers;

use HESCommon\Email;
use HESCommon\Exceptions\UserSafeException;

/**
 * Class EmailHelper
 */
class EmailHelper extends Helper
{
    /**
     * Send an email
     *
     * @access public
     * @param Email $email
     * @return bool
     */
    public static function sendEmail(Email $email) : bool
    {
        $recipient = $email->getRecipient();
        if($recipient === null) {
            throw new UserSafeException('Email is missing a recipient.');
        }
        $subject = $email->getSubject();
        if($subject === null) {
            $email->setSubject('Test Email');
        }
        $message = $email->getMessage();
        if($message === null) {
            $email->setMessage('Test Email');
        }
        
        return $email->send();
    }
}
