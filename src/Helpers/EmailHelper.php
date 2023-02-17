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

        if(env('APP_ENV') === 'production' || env('APP_ENV') === 'sandbox') {
            return $email->send();
        } else {
            return EmailHelper::sendInTestEnvironment($email);
        }
    }

    /**
     * Sends the email with header to the dev team 
     * @param Email $email The email to send
     * @return bool
     */
    private static function sendInTestEnvironment(Email $email)
    {
        $header = $email->createHeader();
        $email->setMessage($header."\n\n".$email->getMessage());
        $email->clearAllRecipients();
        $email->setRecipient(Email::HES_DEV_TEAM_EMAIL);
        return $email->send();
    }
}
