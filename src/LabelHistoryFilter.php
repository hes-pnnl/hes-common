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
    private $assessmentType;

    /**
     * TRUE: only archived buildings pass the filter
     * FALSE: only unarchived buildings pass
     * NULL: archived and unarchived buildings pass
     *
     * @var bool|null
     */
    private $archiveMode = false;

    /** @var bool TRUE: only locked buildings, FALSE: only unlocked buildings, NULL: don't filter on locked/unlocked status */
    private $locked = null;

    /**
     * Initialize an instance of this class from the collection of values that are posted by the filter inputs rendered
     * above each table. Note that this doesn't include every filter option, since some are hard-coded based on the
     * context in which the label history is rendered - for example the Assessor's view always includes a user ID, and
     * the admin view never does.
     *
     * @param array $filterValues
     * @return LabelHistoryFilter
     */
    public static function fromFormValues(array $filterValues)
    {
        $instance = new self();

        if (!empty($filterValues['date-max'])) {
            $maxDate = self::getDateFromFormValue($filterValues['date-max']);
            $instance->setMaxDate($maxDate);
        } else {
            $instance->setMaxDate(date_create_from_format(self::DATE_FORMAT, date(self::DATE_FORMAT, strtotime('+1 months'))));
        }
        if (!empty($filterValues['date-min'])) {
            $minDate = self::getDateFromFormValue($filterValues['date-min']);
            $instance->setMinDate($minDate);
        } else {
            $instance->setMinDate(date_create_from_format(self::DATE_FORMAT, date(self::DATE_FORMAT, strtotime('-3 months'))));
        }
        if (!empty($filterValues['building-id-min']) || !empty($filterValues['building-id-max'])) {
            // Allow the user to set only building ID min or only building ID max. If only
            // one is set then both will be set to the same value.
            $buildingIdMin = empty($filterValues['building-id-min']) ? $filterValues['building-id-max'] : $filterValues['building-id-min'];
            $buildingIdMax = empty($filterValues['building-id-max']) ? $filterValues['building-id-min'] : $filterValues['building-id-max'];

            $instance->setBuildingIdRange($buildingIdMin, $buildingIdMax);
        }
        if (!empty($filterValues['address'])) {
            $instance->setAddress($filterValues['address']);
        }

        // This class supports multiple users in the filter, but our GUI only supports a single user.
        if (!empty($filterValues['user'])) {
            $instance->setUserIds([ $filterValues['user'] ]);
        }

        if (!empty($filterValues['external_building_id'])) {
            $instance->setExternalBuildingId($filterValues['external_building_id']);
        }
        if(!empty($filterValues['archive-mode'])){
            $instance->setArchive(null);
        }
        if(!empty($filterValues['assessment-type'])) {
            $instance->setAssessmentType($filterValues['assessment-type']);
        }

        return $instance;
    }

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
    public function getArchive()
    {
        return $this->archiveMode;
    }

    /**
     * @param bool|null $archive
     */
    public function setArchive($archive)
    {
        if (!is_bool($archive) && null !== $archive) {
            throw new \InvalidArgumentException('$archive must be a boolean value or NULL');
        }

        $this->archiveMode = $archive;
    }

    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * @param bool $locked
     */
    public function setLocked($locked)
    {
        if (!is_bool($locked)) {
            throw new \InvalidArgumentException('$locked must be a boolean value');
        }

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
     * @return string
     */
    public function getAssessmentType() : string
    {
        return $this->assessmentType;
    }

    /**
     * @param string $assessmentType
     */
    public function setAssessmentType(string $assessmentType)
    {
        $this->assessmentType = $assessmentType;
    }

    /**
     * Converts a value submitted from a form into a date
     * @param string $formValue
     * @return \DateTime|null
     */
    private static function getDateFromFormValue(string $formValue) : ?\DateTime
    {
        return date_create_from_format(self::DATE_FORMAT, $formValue) ?: null;
    }
}
