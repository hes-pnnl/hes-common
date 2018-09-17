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
    public function getMinBuildingId()
    {
        return $this->minBuildingId;
    }

    /**
     * @return int
     */
    public function getMaxBuildingId()
    {
        return $this->maxBuildingId;
    }

    /**
     * @param int $minBuildingId
     * @param int $maxBuildingId
     */
    public function setBuildingIdRange($minBuildingId, $maxBuildingId)
    {
        if (intval($maxBuildingId) != $maxBuildingId) {
            throw new \InvalidArgumentException('Param $maxBuildingId must be an integer value');
        }
        if (intval($minBuildingId) != $minBuildingId) {
            throw new \InvalidArgumentException('Param $minBuildingId must be an integer value');
        }
        if ($minBuildingId > $maxBuildingId) {
            $tmp = $minBuildingId;
            $minBuildingId = $maxBuildingId;
            $maxBuildingId = $tmp;
        }

        $this->maxBuildingId = $maxBuildingId;
        $this->minBuildingId = $minBuildingId;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @param string[] $userIds
     */
    public function setUserIds(array $userIds)
    {
        $this->userIds = $userIds;
    }

    /**
     * @return string[]
     */
    public function getUserIds() : array
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
     * @param bool $locked
     */
    public function setLocked(bool $locked)
    {
        $this->locked = $locked;
    }

    /**
     * @return string
     */
    public function getPartner()
    {
        return $this->partner;
    }

    /**
     * @param string $partner
     */
    public function setPartner($partner)
    {
        $this->partner = $partner;
    }

    /**
     * @return int
     */
    public function getExternalBuildingId()
    {
        return $this->externalBuildingId;
    }

    /**
     * @param int $externalBuildingId
     */
    public function setExternalBuildingId($externalBuildingId)
    {
        $this->externalBuildingId = $externalBuildingId;
    }

    /**
     * @return string[]
     */
    public function getAssessmentTypes() : array
    {
        return $this->assessmentTypes;
    }

    /**
     * @param string[] $assessmentTypes
     */
    public function setAssessmentTypes(array $assessmentTypes)
    {
        $this->assessmentTypes = $assessmentTypes;
    }
}
