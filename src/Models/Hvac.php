<?php

namespace HESCommon\Models;

/**
 * Class Hvac - Stores the HVAC values associated with a building
 */
class Hvac
{
    const HEATING_TYPE_HEAT_PUMP = 'heat_pump';
    const HEATING_TYPE_CENTRAL_FURNACE = 'central_furnace';
    const HEATING_TYPE_WALL_FURNACE = 'wall_furnace';
    const HEATING_TYPE_BASEBOARD = 'baseboard';
    const HEATING_TYPE_BOILER = 'boiler';
    const HEATING_TYPE_GHCP = 'gchp';
    const HEATING_TYPE_WOOD_STOVE = 'wood_stove';
    const HEATING_TYPE_MINI_SPLIT = 'mini_split';
    const HEATING_TYPE_NONE = 'none';

    const HEATING_FUEL_ELECTRIC = 'electric';
    const HEATING_FUEL_NATURAL_GAS = 'natural_gas';
    const HEATING_FUEL_LPG = 'lpg';
    const HEATING_FUEL_OIL = 'fuel_oil';
    const HEATING_FUEL_CORD_WOOD = 'cord_wood';
    const HEATING_FUEL_PELLET_WOOD = 'pellet_wood';

    const COOLING_TYPE_PACKAGED_DX = 'packaged_dx';
    const COOLING_TYPE_SPLIT_DX = 'split_dx';
    const COOLING_TYPE_HEAT_PUMP = 'heat_pump';
    const COOLING_TYPE_GHCP = 'gchp';
    const COOLING_TYPE_DEC = 'dec';
    const COOLING_TYPE_MINI_SPLIT = 'mini_split';
    const COOLING_TYPE_NONE = 'none';

    const EFFICIENCY_METHOD_USER = 'user';
    const EFFICIENCY_METHOD_SHIPMENT_WEIGHTED = 'shipment_weighted';

    /** @var float|null */
    protected $fraction;

    /**
     * One of this class's HEATING_TYPE_* constants
     * @var string|null
     */
    protected $heatingType;

    /**
     * One of this class's HEATING_FUEL_* constants
     * @var string|null
     */
    protected $heatingFuel;

    /**
     * One of this class's EFFICIENCY_METHOD_* constants
     * @var string|null
     */
    protected $heatingEfficiencyMethod;

    /** @var int|null */
    protected $heatingYearInstalled;

    /** @var |null */
    protected $heatingEfficiency;

    /**
     * One of this class's COOLING_TYPE_* constants
     * @var string|null
     */
    protected $coolingType;

    /** @var string|null */
    protected $coolingEfficiencyMethod;

    /** @var int|null */
    protected $coolingYearInstalled;

    /** @var float|null */
    protected $coolingEfficiency;

    /** @var Duct[] */
    protected $ducts;

    public function __construct()
    {
        $this->ducts = [1 => new Duct(), 2 => new Duct(), 3 => new Duct()];
    }

    /**
     * @param int $system
     * @return array
     */
    public function getValuesAsArray(int $system)
    {
        return [
            'hvac_fraction_'.$system => $this->getFraction(),
            'heating_fuel_'.$system => $this->getHeatingFuel(),
            'heating_type_'.$system => $this->getHeatingType(),
            'heating_efficiency_method_'.$system => $this->getHeatingEfficiencyMethod(),
            'heating_efficiency_'.$system => $this->getHeatingEfficiency(),
            'heating_year_'.$system => $this->getHeatingYearInstalled(),
            'cooling_type_'.$system => $this->getCoolingType(),
            'cooling_efficiency_method_'.$system => $this->getCoolingEfficiencyMethod(),
            'cooling_efficiency_'.$system => $this->getCoolingEfficiency(),
            'cooling_year_'.$system => $this->getCoolingYearInstalled(),
        ];
    }

    /**
     * @return float|null
     */
    public function getFraction(): ?float
    {
        return $this->fraction;
    }

    /**a
     * @param float|null $fraction
     * @return Hvac
     */
    public function setFraction(?float $fraction): Hvac
    {
        $this->fraction = $fraction;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getHeatingType(): ?string
    {
        return $this->heatingType;
    }

    /**
     * @param null|string $heatingType
     * @return Hvac
     */
    public function setHeatingType(?string $heatingType): Hvac
    {
        $this->heatingType = $heatingType;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getHeatingFuel(): ?string
    {
        return $this->heatingFuel;
    }

    /**
     * @param null|string $heatingFuel
     * @return Hvac
     */
    public function setHeatingFuel(?string $heatingFuel): Hvac
    {
        $this->heatingFuel = $heatingFuel;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getHeatingEfficiencyMethod(): ?string
    {
        return $this->heatingEfficiencyMethod;
    }

    /**
     * @param null|string $heatingEfficiencyMethod
     * @return Hvac
     */
    public function setHeatingEfficiencyMethod(?string $heatingEfficiencyMethod): Hvac
    {
        $this->heatingEfficiencyMethod = $heatingEfficiencyMethod;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getHeatingYearInstalled(): ?int
    {
        return $this->heatingYearInstalled;
    }

    /**
     * @param int|null $heatingYearInstalled
     * @return Hvac
     */
    public function setHeatingYearInstalled(?int $heatingYearInstalled): Hvac
    {
        $this->heatingYearInstalled = $heatingYearInstalled;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeatingEfficiency()
    {
        return $this->heatingEfficiency;
    }

    /**
     * @param mixed $heatingEfficiency
     * @return Hvac
     */
    public function setHeatingEfficiency($heatingEfficiency)
    {
        $this->heatingEfficiency = $heatingEfficiency;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCoolingType(): ?string
    {
        return $this->coolingType;
    }

    /**
     * @param null|string $coolingType
     * @return Hvac
     */
    public function setCoolingType(?string $coolingType): Hvac
    {
        $this->coolingType = $coolingType;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCoolingEfficiencyMethod(): ?string
    {
        return $this->coolingEfficiencyMethod;
    }

    /**
     * @param null|string $coolingEfficiencyMethod
     * @return Hvac
     */
    public function setCoolingEfficiencyMethod(?string $coolingEfficiencyMethod): Hvac
    {
        $this->coolingEfficiencyMethod = $coolingEfficiencyMethod;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCoolingYearInstalled(): ?int
    {
        return $this->coolingYearInstalled;
    }

    /**
     * @param int|null $coolingYearInstalled
     * @return Hvac
     */
    public function setCoolingYearInstalled(?int $coolingYearInstalled): Hvac
    {
        $this->coolingYearInstalled = $coolingYearInstalled;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getCoolingEfficiency(): ?float
    {
        return $this->coolingEfficiency;
    }

    /**
     * @param float|null $coolingEfficiency
     * @return Hvac
     */
    public function setCoolingEfficiency(?float $coolingEfficiency): Hvac
    {
        $this->coolingEfficiency = $coolingEfficiency;
        return $this;
    }

    /**
     * @param int $ductNumber
     * @return Duct
     */
    public function getDuct(int $ductNumber) : Duct
    {
        if (!isset($this->ducts[$ductNumber])) {
            throw new \InvalidArgumentException("$ductNumber is not a valid duct number");
        }

        return $this->ducts[$ductNumber];
    }
}
