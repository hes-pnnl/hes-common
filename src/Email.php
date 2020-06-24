<?php
/**
 * class Email - A data container for the values used to create/send an email
 */
namespace HESCommon;

use HESCommon\Exceptions\UserSafeException;

class Email
{
    // Email addresses our system has permission to send from
    const HES_MAIN_EMAIL = 'homeenergyscore@ee.doe.gov';
    const DOE_ASSESSOR_CONTACT_EMAIL = 'assessor@ee.doe.gov';
    const HES_DEV_TEAM_EMAIL = 'hes.dev.team@pnnl.gov';
    const HES_HELP_DESK_EMAIL = 'hes.helpdesk@pnnl.gov';
    const HES_ERRORS_EMAIL = 'hes.errors@pnnl.gov';
    const HES_API_SUPPORT_EMAIL = 'hes.api.support@pnnl.gov';

    const VALID_FROM_EMAILS = [
        self::HES_MAIN_EMAIL,
        self::DOE_ASSESSOR_CONTACT_EMAIL,
        self::HES_DEV_TEAM_EMAIL,
        self::HES_HELP_DESK_EMAIL,
        self::HES_ERRORS_EMAIL,
        self::HES_API_SUPPORT_EMAIL
    ];

    /** @var string */
    private $recipient;

    /** @var string */
    private $subject;

    /** @var string */
    private $message;

    /** @var string */
    private $from;

    /** @var string */
    private $cc;

    /** @var string */
    private $replyTo;

    /**
     * @return string|null
     */
    public function getRecipient() : ?string
    {
        return $this->recipient;
    }

    /**
     * @param string $recipient
     */
    public function setRecipient(?string $recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * @return string|null
     */
    public function getSubject() : ?string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(?string $subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return string|null
     */
    public function getMessage() : ?string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(?string $message)
    {
        $this->message = $message;
    }

    /**
     * @return string|null
     */
    public function getFrom() : ?string
    {
        return $this->from;
    }

    /**
     * @param string $from
     */
    public function setFrom(?string $from)
    {
        if(!in_array($from, self::VALID_FROM_EMAILS)) {
            $emailsList = implode(', ', self::VALID_FROM_EMAILS);
            throw new UserSafeException("
                '$from' is not an email address HES recognizes. Valid options are $emailsList.
            ");
        }
        $this->from = $from;
    }

    /**
     * @return string|null
     */
    public function getCC() : ?string
    {
        return $this->cc;
    }

    /**
     * @param string $cc
     */
    public function setCC(?string $cc)
    {
        $this->cc = $cc;
    }

    /**
     * @return string|null
     */
    public function getReplyTo() : ?string
    {
        return $this->replyTo;
    }

    /**
     * @param string $replyTo
     */
    public function setReplyTo(?string $replyTo)
    {
        $this->replyTo = $replyTo;
    }
}
