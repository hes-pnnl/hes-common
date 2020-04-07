<?php
namespace HESCommon\Models;

/**
 * Class QAProvider
 * QAProvider information.
 */
class QAProvider extends Model
{

    /** @var int|null */
    private $id;
    
    /** @var string */
    private $name;

    /** @var int */
    private $statusId;

    /** @var int|null */
    private $softwareProviderId;

    /** @var string|null */
    private $application;

    /**
     * @return QAProvider
     * @param int $id
     */
    public function setId(int $id) : QAProvider
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return QAProvider
     * @param string $name
     */
    public function setName(string $name) : QAProvider
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return QAProvider
     * @param int $statusId
     */
    public function setStatusId(int $statusId) : QAProvider
    {
        $this->statusId = $statusId;
        return $this;
    }

    /**
     * @return QAProvider
     * @param int $softwareProviderId
     */
    public function setSoftwareProviderId(?int $softwareProviderId) : QAProvider
    {
        $this->softwareProviderId = $softwareProviderId;
        return $this;
    }

    /**
     * @param string|null $application
     * @return QAProvider
     */
    public function setApplication(?string $application): QAProvider
    {
        $this->application = $application;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getStatusId(): int
    {
        return $this->statusId;
    }

    /**
     * @return int|null
     */
    public function getSoftwareProviderId(): ?int
    {
        return $this->softwareProviderId;
    }

    /**
     * @return string|null
     */
    public function getApplication(): ?string
    {
        return $this->application;
    }
    
}