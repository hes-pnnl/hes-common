<?php
/**
 * class LabelHistoryFilter - A data container for the values that can be used to filter the results of the
 * retrieve_building_by_id API method
 */
namespace HESCommon;

class LabelHistoryFilter
{
    /** @var DateRange */
    private $dateRange;

    /** @var integer */
    private $minBuildingId;

    /** @var integer */
    private $maxBuildingId;

    /** @var integer */
    private $externalBuildingId;

    /** @var string */
    private $address;

    /** @var string */
    private $userId;

    /** @var string */
    private $partner;

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
     * @param array $values
     * @return LabelHistoryFilter
     */
    public static function fromFormValues(array $values) : LabelHistoryFilter
    {
        $instance = new static();

        if (!empty($values['date-range'])) {
            $dateRange = DateRange::fromString($values['date-range']);
            $instance->setDateRange($dateRange);
        }
        if (!empty($values['building-id-min']) || !empty($values['building-id-max'])) {
            // Allow the user to set only building ID min or only building ID max. If only
            // one is set then both will be set to the same value.
            $buildingIdMin = $values['building-id-min'] ?? $values['building-id-max'];
            $buildingIdMax = $values['building-id-max'] ?? $values['building-id-min'];

            $instance->setBuildingIdRange($buildingIdMin, $buildingIdMax);
        }
        if (!empty($values['address'])) {
            $instance->setAddress($values['address']);
        }
        if (!empty($values['user'])) {
            $instance->setUserId($values['user']);
        }
        if (!empty($values['external_building_id'])) {
            $instance->setExternalBuildingId($values['external_building_id']);
        }

        return $instance;
    }

    public function getDateRange() : DateRange
    {
        return $this->dateRange;
    }

    /**
     * @param DateRange $dateRange
     */
    public function setDateRange(DateRange $dateRange)
    {
        $this->dateRange = $dateRange;
    }

    /**
     * @return int
     */
    public function getMinBuildingId() : int
    {
        return $this->minBuildingId;
    }

    /**
     * @return int
     */
    public function getMaxBuildingId() : int
    {
        return $this->maxBuildingId;
    }

    /**
     * @param int $minBuildingId
     * @param int $maxBuildingId
     */
    public function setBuildingIdRange(int $minBuildingId, int $maxBuildingId)
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
    public function getAddress() : string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @param string $userId
     */
    public function setUserId(string $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getUserId() : string
    {
        return $this->userId;
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
        if (!is_bool($archive) && null !== $archive) {
            throw new \InvalidArgumentException('$archive must be a boolean value or NULL');
        }

        $this->archiveMode = $archive;
    }

    /**
     * @return bool
     */
    public function getLocked() : bool
    {
        return $this->locked;
    }

    /**
     * @param bool $locked
     */
    public function setLocked(bool $locked)
    {
        if (!is_bool($locked)) {
            throw new \InvalidArgumentException('$locked must be a boolean value');
        }

        $this->locked = $locked;
    }

    /**
     * @return string
     */
    public function getPartner() : string
    {
        return $this->partner;
    }

    /**
     * @param string $partner
     */
    public function setPartner(string $partner)
    {
        $this->partner = $partner;
    }

    /**
     * @return string
     */
    public function getExternalBuildingId() : string
    {
        return $this->externalBuildingId;
    }

    /**
     * @param string $externalBuildingId
     */
    public function setExternalBuildingId(string $externalBuildingId)
    {
        $this->externalBuildingId = $externalBuildingId;
    }
}