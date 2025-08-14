<?php
namespace HESCommon\Models;

/**
 * Class ApiKey
 * ApiKey information.
 */
class ApiKey extends Model
{

    /** @var int|null */
    private $id;
    
    /** @var string */
    private $apiKey;

    /** @var int */
    private $statusId;

    /** @var int|null */
    private $softwareProviderId;
    
    /** @var string|null */
    private $application;

    /**
     * @return ApiKey
     * @param int $id
     */
    public function setId(int $id) : ApiKey
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $apiKey
     * @return ApiKey
     */
    public function setApiKey(string $apiKey): ApiKey
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @return ApiKey
     * @param int $statusId
     */
    public function setStatusId(int $statusId) : ApiKey
    {
        $this->statusId = $statusId;
        return $this;
    }

    /**
     * @return ApiKey
     * @param int $softwareProviderId
     */
    public function setSoftwareProviderId(?int $softwareProviderId) : ApiKey
    {
        $this->softwareProviderId = $softwareProviderId;
        return $this;
    }

    /**
     * @param string $application
     * @return ApiKey
     */
    public function setApplication(?string $application): ApiKey
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
    public function getApiKey(): string
    {
        return $this->apiKey;
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