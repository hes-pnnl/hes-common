<?php

namespace HESCommon\Models;

use HESCommon\Helpers\BooleanHelper;

/**
 * Class Duct - Stores values associated with a single set of ductwork for an HVAC system
 */
class Duct extends Model
{
    const LOCATION_CONDITIONED_SPACE = 'cond_space';
    const LOCATION_UNCONDITIONED_BASEMENT = 'uncond_basement';
    const LOCATION_UNVENTED_CRAWLSPACE = 'unvented_crawl';
    const LOCATION_VENTED_CRAWLSPACE = 'vented_crawl';
    const LOCATION_UNCONDITIONED_ATTIC = 'uncond_attic';
    const LOCATION_UNDER_SLAB = 'under_slab';
    const LOCATION_EXTERIOR_WALL = 'exterior_wall';
    const LOCATION_OUTSIDE = 'outside';
    const LOCATION_BELLY = 'manufactured_home_belly';

    /**
     * One of this class's LOCATION_* constants
     * @var string|null
     */
    protected $location;

    /** @var float|null */
    protected $fraction;

    /** @var bool|null */
    protected $insulated;

    /**
     * @param int $system
     * @param int $count
     * @return array
     */
    public function getValuesAsArray(int $system, int $count)
    {
        return [
            'duct_location_'.$count.'_'.$system => $this->getLocation(),
            'duct_fraction_'.$count.'_'.$system => $this->getFraction(),
            'duct_insulated_'.$count.'_'.$system => BooleanHelper::getIntValForThreeValueBoolean($this->isInsulated()),
        ];
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return !($this->getLocation() || $this->getFraction() || $this->isInsulated());
    }

    /**
     * @return null|string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param null|string $location
     * @return Duct
     */
    public function setLocation(?string $location): Duct
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getFraction(): ?float
    {
        return $this->fraction;
    }

    /**
     * @param int|null $fraction
     * @return Duct
     */
    public function setFraction(?float $fraction): Duct
    {
        $this->fraction = $fraction;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isInsulated(): ?bool
    {
        return $this->insulated;
    }

    /**
     * @param bool|null $insulated
     * @return Duct
     */
    public function setInsulated(?bool $insulated): Duct
    {
        $this->insulated = $insulated;
        return $this;
    }
}
