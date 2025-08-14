<?php
/**
 * class Email - A data container for the values used to create/send an email
 */
namespace HESCommon;

use HESCommon\Exceptions\UserSafeException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email extends PHPMailer
{
    // Email addresses common in our system
    const HES_MAIN_EMAIL = 'homeenergyscore@ee.doe.gov';
    const DOE_ASSESSOR_CONTACT_EMAIL = 'assessor@ee.doe.gov';
    const HES_DEV_TEAM_EMAIL = 'hes.dev.team@pnnl.gov';
    const HES_HELP_DESK_EMAIL = 'hes.helpdesk@pnnl.gov';
    const HES_ERRORS_EMAIL = 'hes.errors@pnnl.gov';
    const HES_API_SUPPORT_EMAIL = 'hes.api.support@pnnl.gov';

    // Email addresses our system has permission to send from
    const VALID_FROM_EMAILS = [
        self::HES_DEV_TEAM_EMAIL,
        self::HES_HELP_DESK_EMAIL,
        self::HES_ERRORS_EMAIL,
        self::HES_API_SUPPORT_EMAIL
    ];

    public function __construct() {
        $this->exceptions = true;
        $this->From = self::HES_API_SUPPORT_EMAIL;
        $this->FromName = "Home Energy Score";
    }

    /**
     * @param string $method - The getter method from PHPMailer
     * @return string|null
     */
    private function getSingleAddress(string $method) {
        $addresses = $this->$method();
        return count($addresses) ? $addresses[0][0] : null;
    }

    /**
     * @param string $method - The setter method from PHPMailer
     * @param string $address - The address
     */
    private function setSingleAddress(string $addMethod, string $clearMethod, string $address) {
        $this->$clearMethod();
        $addresses = explode(',', $address);
        foreach( $addresses as $add ){
            $this->$addMethod(trim($add));
        }
    }

    /**
     * @return string|null
     */
    public function getRecipient() : ?string
    {
        return $this->getSingleAddress('getToAddresses');
    }

    /**
     * @param string $recipient
     */
    public function setRecipient(?string $recipient)
    {
        $this->setSingleAddress('addAddress', 'clearAddresses', $recipient);
    }

    /**
     * @return string|null
     */
    public function getSubject() : ?string
    {
        return $this->Subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(?string $subject)
    {
        $this->Subject = $subject;
    }

    /**
     * @return string|null
     */
    public function getMessage() : ?string
    {
        return $this->Body;
    }

    /**
     * @param string $message
     */
    public function setMessage(?string $message)
    {
        $this->Body = $message;
    }

    /**
     * @return string|null
     */
    public function getFrom() : ?string
    {
        return $this->From;
    }

    /**
     * @param string $from
     */
    public function setFrom($from, $name = '', $auto = true)
    {
        if(!in_array($from, self::VALID_FROM_EMAILS)) {
            $emailsList = implode(', ', self::VALID_FROM_EMAILS);
            throw new UserSafeException("
                '$from' is not an email address HES recognizes. Valid options are $emailsList.
            ");
        }
        parent::setFrom($from);
    }

    /**
     * @return string|null
     */
    public function getCC() : ?string
    {
        return $this->getSingleAddress('getCcAddresses');
    }

    /**
     * @param string $cc
     */
    public function setCC(?string $cc)
    {
        $this->setSingleAddress('addCC', 'clearCCs', $cc);
    }

    /**
     * @return string|null
     */
    public function getReplyTo() : ?string
    {
        return $this->getSingleAddress('getReplyToAddresses');
    }

    /**
     * @param string $replyTo
     */
    public function setReplyTo(?string $replyTo)
    {
        $this->setSingleAddress('addReplyTo', 'clearReplyTos', $replyTo);
    }

    public static function getFooterTemplate()
    {
            $emailAddress = self::DOE_ASSESSOR_CONTACT_EMAIL;
            return <<<FOOTER
            <p>
                The Home Energy Score Team <br/>
                <a href="www.homeenergyscore.gov">www.homeenergyscore.gov</a>
            </p>
            <p>
                Technical Team - Home Energy Scoring Tool, Training, Test, and Quality Assurance <br/>
                Torsten Glidden <br/>
                Erik Lundquist <br/>
                <a href="mailto:{$emailAddress}">{$emailAddress}</a>
            </p>
FOOTER
                ;
        }
}
