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
            $subject = 'Test Email';
        }
        $message = $email->getMessage();
        if($message === null) {
            $message = 'Test Email';
        }

        $from = $email->getFrom();
        if ($from === null) {
            $from = 'hes.api.support@pnnl.gov';
        }
        $headers['From'] = $from;
        $cc = $email->getCC();
        if ($cc !== null) {
            $headers['Cc'] = $cc;
        }
        $replyTo = $email->getReplyTo();
        if ($replyTo !== null) {
            $headers['Reply-To'] = $replyTo;
        }
        
        return mail($recipient, $subject, $message, $headers, "-f $from");
    }
}
