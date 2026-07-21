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
    private $softwareProviderId;

    /** @var string|null */
    private $assessorPrefix;

    /** @var int */
    private $assessorCount;

    /** @var string|null */
    private $labelConfigurationStatus;
    
    /** @var string|null One of the Partners::REVIEW_STRATEGY_* constants */
    private $assessorProfileStrategy;

    /** @var int|null */
    private $statusId;

    /** @var bool */
    private $apartmentUnitEnabled;

    /** @var bool */
    private $manufacturedHomeEnabled;

    /** @var string[]|null Zip codes the partner is restricted to for MultiFamily Building Units. NULL means not restricted */
    private $apartmentUnitZipCodes;

    /** @var string[]|null Zip codes the partner is restricted to for Manufactured Homes. NULL means not restricted */
    private $manufacturedHomeZipCodes;

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
     * @param string|null $labelConfigurationStatus
     * @return Partner
     */
    public function setLabelConfigurationStatus(?string $labelConfigurationStatus): Partner
    {
        $this->labelConfigurationStatus = $labelConfigurationStatus;
        return $this;
    }

    /**
     * @param string|null $assessorProfileStrategy One of the Partners::REVIEW_STRATEGY_* constants
     * @return Partner
     */
    public function setAssessorProfileStrategy(?string $assessorProfileStrategy): Partner
    {
        $this->assessorProfileStrategy = $assessorProfileStrategy;
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
     * @param int|null $statusId
     */
    public function setApartmentUnitEnabled(bool $status) : Partner
    {
        $this->apartmentUnitEnabled = $status;
        return $this;
    }

    /**
     * @return Partner
     * @param int|null $statusId
     */
    public function setManufacturedHomeEnabled(bool $status) : Partner
    {
        $this->manufacturedHomeEnabled = $status;
        return $this;
    }

    /**
     * @param string[]|null $zipCodes NULL means not restricted by zip code
     * @return Partner
     */
    public function setApartmentUnitZipCodes(?array $zipCodes) : Partner
    {
        $this->apartmentUnitZipCodes = $zipCodes;
        return $this;
    }

    /**
     * @param string[]|null $zipCodes NULL means not restricted by zip code
     * @return Partner
     */
    public function setManufacturedHomeZipCodes(?array $zipCodes) : Partner
    {
        $this->manufacturedHomeZipCodes = $zipCodes;
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
    public function getSoftwareProviderId(): ?int
    {
        return $this->softwareProviderId;
    }

    /**
     * @return string|null
     */
    public function getAssessorPrefix(): string
    {
        return $this->assessorPrefix ?? '';
    }

    /**
     * @return int
     */
    public function getAssessorCount(): int
    {
        return $this->assessorCount;
    }

    /**
     * @return string|null
     */
    public function getLabelConfigurationStatus(): ?string
    {
        return $this->labelConfigurationStatus;
    }

    /**
     * @return string|null
     */
    public function getAssessorProfileStrategy(): ?string
    {
        return $this->assessorProfileStrategy;
    }

    /**
     * @return int|null
     */
    public function getStatusId(): ?int
    {
        return $this->statusId;
    }

    /**
     * @return bool
     */
    public function getApartmentUnitEnabled(): bool
    {
        return $this->apartmentUnitEnabled;
    }

    /**
     * @return bool
     */
    public function getManufacturedHomeEnabled(): bool
    {
        return $this->manufacturedHomeEnabled;
    }

    /**
     * @return string[]|null NULL means not restricted by zip code
     */
    public function getApartmentUnitZipCodes(): ?array
    {
        return $this->apartmentUnitZipCodes;
    }

    /**
     * @return string[]|null NULL means not restricted by zip code
     */
    public function getManufacturedHomeZipCodes(): ?array
    {
        return $this->manufacturedHomeZipCodes;
    }
}