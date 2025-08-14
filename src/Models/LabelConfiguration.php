<?php

namespace HESCommon\Models;

/**
 * Class Assessor - Contains the Assessor information.
 */
class LabelConfiguration extends Model
{

    /** @var int|null */
    protected $id;

    /** @var string|null */
    protected $name;

    /** @var string|null */
    protected $abbreviation;

    /** @var string|null */
    protected $url;

    /** @var int */
    protected $hesPartnerId;

    /** @var string */
    protected $status;

    /** @var float */
    protected $averageScore;

    /** @var int */
    protected $templateId;

    /** @var string|null */
    protected $logo;

    /** @var bool */
    protected $hideEmissions;

    /** @var bool */
    protected $showAverageHomeCost;

    /** @var bool */
    protected $removeEnergyCost;

    /** @var bool */
    protected $removeCurrentlyWastes;

    /** @var int[] */
    protected $homeFactIds;

    //Getter methods

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getAbbreviation(): ?string
    {
        return $this->abbreviation;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return int
     */
    public function getHesPartnerId(): int
    {
        return $this->hesPartnerId;
    }

    /**
     * @return int
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getTemplateId(): int
    {
        return $this->templateId;
    }

    /**
     * @return float
     */
    public function getAverageScore(): float
    {
        return $this->averageScore;
    }

    /**
     * @return string|null
     */
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    /**
     * @return bool
     */
    public function getHideEmissions(): bool
    {
        return $this->hideEmissions;
    }

    /**
     * @return bool
     */
    public function getShowAverageHomeCost(): bool
    {
        return $this->showAverageHomeCost;
    }

    /**
     * @return bool
     */
    public function getRemoveEnergyCost(): bool
    {
        return $this->removeEnergyCost;
    }

    /**
     * @return bool
     */
    public function getRemoveCurrentlyWastes(): bool
    {
        return $this->removeCurrentlyWastes;
    }

    /**
     * @return int[]
     */
    public function getHomeFactIds(): array
    {
        return $this->homeFactIds;
    }


    //Setter methods

    /**
     * @param int $id
     * @return LabelConfiguration
     */
    public function setId(int $id): LabelConfiguration
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string|null $name
     * @return LabelConfiguration
     */
    public function setName(?string $name): LabelConfiguration
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string|null $abbreviation
     * @return LabelConfiguration
     */
    public function setAbbreviation(?string $abbreviation): LabelConfiguration
    {
        $this->abbreviation = $abbreviation;
        return $this;
    }

    /**
     * @param string|null $url
     * @return LabelConfiguration
     */
    public function setUrl(?string $url): LabelConfiguration
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param int $hesPartnerId
     * @return LabelConfiguration
     */
    public function setHesPartnerId(int $hesPartnerId): LabelConfiguration
    {
        $this->hesPartnerId = $hesPartnerId;
        return $this;
    }

    /**
     * @param string $status
     * @return LabelConfiguration
     */
    public function setStatus(string $status): LabelConfiguration
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param int $templateId
     * @return LabelConfiguration
     */
    public function setTemplateId(int $templateId): LabelConfiguration
    {
        $this->templateId = $templateId;
        return $this;
    }

    /**
     * @param float $averageScore
     * @return LabelConfiguration
     */
    public function setAverageScore(float $averageScore): LabelConfiguration
    {
        $this->averageScore = $averageScore;
        return $this;
    }

    /**
     * @param string|null $logo
     * @return LabelConfiguration
     */
    public function setLogo(?string $logo): LabelConfiguration
    {
        $this->logo = $logo;
        return $this;
    }

    /**
     * @param bool $hideEmissions
     * @return LabelConfiguration
     */
    public function setHideEmissions(bool $hideEmissions): LabelConfiguration
    {
        $this->hideEmissions = $hideEmissions;
        return $this;
    }

    /**
     * @param bool $showAverageHomeCost
     * @return LabelConfiguration
     */
    public function setShowAverageHomeCost(bool $showAverageHomeCost): LabelConfiguration
    {
        $this->showAverageHomeCost = $showAverageHomeCost;
        return $this;
    }

    /**
     * @param bool $removeEnergyCost
     * @return LabelConfiguration
     */
    public function setRemoveEnergyCost(bool $removeEnergyCost): LabelConfiguration
    {
        $this->removeEnergyCost = $removeEnergyCost;
        return $this;
    }

    /**
     * @param bool $removeCurrentlyWastes
     * @return LabelConfiguration
     */
    public function setRemoveCurrentlyWastes(bool $removeCurrentlyWastes): LabelConfiguration
    {
        $this->removeCurrentlyWastes = $removeCurrentlyWastes;
        return $this;
    }

    /**
     * @param int[] $homeFactIds
     * @return LabelConfiguration
     */
    public function setHomeFactIds(array $homeFactIds): LabelConfiguration
    {
        $this->homeFactIds = $homeFactIds;
        return $this;
    }
}
