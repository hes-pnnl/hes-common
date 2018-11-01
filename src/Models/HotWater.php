<?php

namespace HESCommon\Models;

/**
 * Class HotWater - Stores water heater information for a building
 */
class HotWater extends Model
{
    const CATEGORY_UNIT = 'unit';
    const CATEGORY_COMBINED = 'combined';

    const TYPE_STORAGE = 'storage';
    const TYPE_INDIRECT = 'indirect';
    const TYPE_TANKLESS_COIL = 'tankless_coil';
    const TYPE_HEAT_PUMP = 'heat_pump';

    const FUEL_ELECTRIC = 'electric';
    const FUEL_NATURAL_GAS = 'natural_gas';
    const FUEL_LPG = 'lpg';
    const FUEL_OIL = 'fuel_oil';

    const EFFICIENCY_METHOD_USER = 'user';
    const EFFICIENCY_METHOD_SHIPMENT_WEIGHTED = 'shipment_weighted';

    /**
     * One of this class's CATEGORY_* constants
     * @var string|null
     */
    protected $category;

    /**
     * One of this class's TYPE_* constants
     * @var string|null
     */
    protected $type;

    /**
     * One of this class's FUEL_* constants
     * @var string|null
     */
    protected $fuel;

    /**
     * One of this class's EFFICIENCY_METHOD_* constants
     * @var string|null
     */
    protected $efficiencyMethod;

    /** @var int|null */
    protected $yearInstalled;

    /** @var float|null */
    protected $energyFactor;

    /**
     * @return array
     */
    public function getValuesAsArray()
    {
        return [
            'hot_water_type' => $this->getType(),
            'hot_water_fuel' => $this->getFuel(),
            'hot_water_efficiency_method' => $this->getEfficiencyMethod(),
            'hot_water_year' => $this->getYearInstalled(),
            'hot_water_energy_factor' => $this->getEnergyFactor(),
        ];
    }

    /**
     * Note that there is no setter for category - the category is set automatically when the type is set, because
     * the two are linked.
     *
     * @return null|string
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * @return null|string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param null|string $type
     * @return HotWater
     */
    public function setType(?string $type): HotWater
    {
        $this->type = $type;

        if (in_array($type, [ self::TYPE_INDIRECT, self::TYPE_TANKLESS_COIL ])) {
            $this->category = self::CATEGORY_COMBINED;
        } else {
            $this->category = self::CATEGORY_UNIT;
        }

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFuel(): ?string
    {
        return $this->fuel;
    }

    /**
     * @param null|string $fuel
     * @return HotWater
     */
    public function setFuel(?string $fuel): HotWater
    {
        $this->fuel = $fuel;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getEfficiencyMethod(): ?string
    {
        return $this->efficiencyMethod;
    }

    /**
     * @param null|string $efficiencyMethod
     * @return HotWater
     */
    public function setEfficiencyMethod(?string $efficiencyMethod): HotWater
    {
        $this->efficiencyMethod = $efficiencyMethod;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getYearInstalled(): ?int
    {
        return $this->yearInstalled;
    }

    /**
     * @param int|null $yearInstalled
     * @return HotWater
     */
    public function setYearInstalled(?int $yearInstalled): HotWater
    {
        $this->yearInstalled = $yearInstalled;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getEnergyFactor(): ?float
    {
        return $this->energyFactor;
    }

    /**
     * @param float|null $energyFactor
     * @return HotWater
     */
    public function setEnergyFactor(?float $energyFactor): HotWater
    {
        $this->energyFactor = $energyFactor;
        return $this;
    }
}
