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

    /** @var int */
    private $statusId;

    /** @var int|null */
    private $softwareProviderId;

    /** @var string */
    private $assessorPrefix;

    /** @var int */
    private $hescoreLabelStatusId;
    
    /** @var int */
    private $assessorProfileStrategyId;

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
     * @param int $statusId
     */
    public function setStatusId(int $statusId) : Partner
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
     * @param string $assessorPrefix
     * @return Partner
     */
    public function setAssessorPrefix(string $assessorPrefix): Partner
    {
        $this->assessorPrefix = $assessorPrefix;
        return $this;
    }

    /**
     * @param int $hescoreLabelStatusId
     * @return Partner
     */
    public function setHescoreLabelStatusId(int $hescoreLabelStatusId): Partner
    {
        $this->hescoreLabelStatusId = $hescoreLabelStatusId;
        return $this;
    }

    /**
     * @param int $assessorProfileStrategyId
     * @return Partner
     */
    public function setAssessorProfileStrategyId(int $assessorProfileStrategyId): Partner
    {
        $this->hescoreLabelStatusId = $assessorProfileStrategyId;
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
     * @return string
     */
    public function getAssessorPrefix(): string
    {
        return $this->assessorPrefix;
    }

    /**
     * @return int
     */
    public function getHescoreLabelStatusId(): int
    {
        return $this->hescoreLabelStatusId;
    }

    /**
     * @return int
     */
    public function getAssessorProfileStrategyId(): int
    {
        return $this->assessorProfileStrategyId;
    }
    
}