<?php
/**
 * class LabelHistoryFilter - A data container for the values that can be used to filter the results of the
 * retrieve_building_by_id API method
 */
namespace HESCommon;

class LabelHistoryFilter
{
    /**
     * The format in which this filter expects dates to be formatted
     */
    const DATE_FORMAT = 'Y-m-d';

    /** @var \DateTime */
    private $maxDate;

    /** @var \DateTime */
    private $minDate;

    /** @var integer */
    private $minBuildingId;

    /** @var integer */
    private $maxBuildingId;

    /** @var integer */
    private $externalBuildingId;

    /** @var string */
    private $address;

    /** @var string[] */
    private $userIds;

    /** @var string */
    private $partner;

    /** @var string */
    private $mentee;
    
    /** @var string[] */
    private $assessmentTypes;

    /**
     * TRUE: Only archived buildings pass the filter
     * FALSE: Only non-archived buildings pass the filter
     * NULL: Both archived and non-archived buildings pass the filter
     * @var bool|null
     */
    private $archiveMode;

    /**
     * TRUE: Only locked buildings pass the filter
     * FALSE: Only non-locked buildings pass the filter
     * NULL: Both locked and non-locked buildings pass the filter
     * @var bool|null
     */
    private $locked;

    /**
     * @return \DateTime|null
     */
    public function getMaxDate() : ?\DateTime
    {
        return $this->maxDate;
    }

    /**
     * @param \DateTime $maxDate
     */
    public function setMaxDate(?\DateTime $maxDate)
    {
        $this->maxDate = $maxDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getMinDate() : ?\DateTime
    {
        return $this->minDate;
    }

    /**
     * @param \DateTime $minDate
     */
    public function setMinDate(?\DateTime $minDate)
    {
        $this->minDate = $minDate;
    }

    /**
     * @return int
     */
    public function getMinBuildingId() : ?int
    {
        return $this->minBuildingId;
    }

    /**
     * @param int $minBuildingId
     */
    public function setMinBuildingId(int $minBuildingId)
    {
        $this->minBuildingId = $minBuildingId;
    }

    /**
     * @return int
     */
    public function getMaxBuildingId() : ?int
    {
        return $this->maxBuildingId;
    }

    /**
     * @param int $maxBuildingId
     */
    public function setMaxBuildingId(int $maxBuildingId)
    {
        $this->maxBuildingId = $maxBuildingId;
    }

    /**
     * @return string|null
     */
    public function getAddress() : ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address)
    {
        $this->address = $address;
    }

    /**
     * @param string[]|null $userIds
     */
    public function setUserIds(?array $userIds)
    {
        $this->userIds = $userIds;
    }

    /**
     * @return string[]|null
     */
    public function getUserIds() : ?array
    {
        return $this->userIds;
    }

    /**
     * @return bool|null
     */
    public function getArchive() : ?bool
    {
        return $this->archiveMode;
    }

    /**
     * @param bool|null $archive
     */
    public function setArchive(?bool $archive)
    {
        $this->archiveMode = $archive;
    }

    /**
     * @return bool|null
     */
    public function getLocked() : ?bool
    {
        return $this->locked;
    }

    /**
     * @param bool|null $locked
     */
    public function setLocked(?bool $locked)
    {
        $this->locked = $locked;
    }

    /**
     * @return string|null
     */
    public function getPartner() : ?string
    {
        return $this->partner;
    }

    /**
     * @param string $partner
     */
    public function setPartner(?string $partner)
    {
        $this->partner = $partner;
    }

    /**
     * @return string|null
     */
    public function getMentee() : ?string
    {
        return $this->mentee;
    }

    /**
     * @param string $mentee
     */
    public function setMentee(?string $mentee)
    {
        $this->mentee = $mentee;
    }

    /**
     * @return string|null
     */
    public function getExternalBuildingId() : ?string
    {
        return $this->externalBuildingId;
    }

    /**
     * @param string|null $externalBuildingId
     */
    public function setExternalBuildingId(?string $externalBuildingId)
    {
        $this->externalBuildingId = $externalBuildingId;
    }

    /**
     * @return string[]|null
     */
    public function getAssessmentTypes() : ?array
    {
        return $this->assessmentTypes;
    }

    /**
     * @param string[]|null $assessmentTypes
     */
    public function setAssessmentTypes(?array $assessmentTypes)
    {
        $this->assessmentTypes = $assessmentTypes;
    }
}
