<?php
namespace HESCommon\Models;

/**
 * Class Partner
 * Partner information.
 */
class Partner extends Model
{

    /** @var int|null */
    private $id;
    
    /** @var string */
    private $name;

    /** @var int|null */
    private $statusId;

    /** @var int|null */
    private $softwareProviderId;

    /** @var string|null */
    private $assessorPrefix;

    /** @var int */
    private $assessorCount;

    /** @var int|null */
    private $hescoreLabelStatusId;
    
    /** @var string|null */
    private $assessorProfileStrategy;

    /**
     * @return Partner
     * @param int $id
     */
    public function setId(int $id) : Partner
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Partner
     * @param string $name
     */
    public function setName(string $name) : Partner
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Partner
     * @param int|null $statusId
     */
    public function setStatusId(?int $statusId) : Partner
    {
        $this->statusId = $statusId;
        return $this;
    }

    /**
     * @return Partner
     * @param int $softwareProviderId
     */
    public function setSoftwareProviderId(?int $softwareProviderId) : Partner
    {
        $this->softwareProviderId = $softwareProviderId;
        return $this;
    }

    /**
     * @param string|null $assessorPrefix
     * @return Partner
     */
    public function setAssessorPrefix(?string $assessorPrefix): Partner
    {
        $this->assessorPrefix = $assessorPrefix;
        return $this;
    }

    /**
     * @return Partner
     * @param int $assessorCount
     */
    public function setAssessorCount(int $assessorCount) : Partner
    {
        $this->assessorCount = $assessorCount;
        return $this;
    }

    /**
     * @param int|null $hescoreLabelStatusId
     * @return Partner
     */
    public function setHescoreLabelStatusId(?int $hescoreLabelStatusId): Partner
    {
        $this->hescoreLabelStatusId = $hescoreLabelStatusId;
        return $this;
    }

    /**
     * @param string|null $assessorProfileStrategy
     * @return Partner
     */
    public function setAssessorProfileStrategy(?string $assessorProfileStrategy): Partner
    {
        $this->assessorProfileStrategy = $assessorProfileStrategy;
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
     * @return int|null
     */
    public function getStatusId(): ?int
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
    public function getAssessorPrefix(): ?string
    {
        return $this->assessorPrefix;
    }

    /**
     * @return int
     */
    public function getAssessorCount(): int
    {
        return $this->assessorCount;
    }

    /**
     * @return int|null
     */
    public function getHescoreLabelStatusId(): ?int
    {
        return $this->hescoreLabelStatusId;
    }

    /**
     * @return string|null
     */
    public function getAssessorProfileStrategy(): ?string
    {
        return $this->assessorProfileStrategy;
    }
}