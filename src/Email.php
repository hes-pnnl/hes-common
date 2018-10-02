<?php
/**
 * class Email - A data container for the values used to create/send an email
 */
namespace HESCommon;

class Email
{
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
