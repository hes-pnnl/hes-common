<?php

namespace HESCommon\Models;

/**
 * Class Photovoltaic - Stores values related to the photovoltaic generation capabilities of a Building
 */
class Photovoltaic extends Model
{
    const ORIENTATION_NORTH     = 'north';
    const ORIENTATION_SOUTH     = 'south';
    const ORIENTATION_EAST      = 'east';
    const ORIENTATION_WEST      = 'west';
    const ORIENTATION_NORTHEAST = 'north_east';
    const ORIENTATION_NORTHWEST = 'north_west';
    const ORIENTATION_SOUTHEAST = 'south_east';
    const ORIENTATION_SOUTHWEST = 'south_west';

    const TILT_FLAT = 'flat';
    const TILT_LOW_SLOPE = 'low_slope';
    const TILT_MEDIUM_SLOPE = 'medium_slope';
    const TILT_STEEP_SLOPE = 'steep_slope';

    /** @var int|null */
    protected $capacityKnown;

    /** @var float|null */
    protected $systemCapacity;

    /** @var int|null */
    protected $numPanels;

    /** @var int|null */
    protected $year;

    /**
     * @var int|null
     * */
    protected $numberUnitsSharingSystem;

    /**
     * One of this class's ORIENTATION_* constants
     * @var string|null
     */
    protected $arrayAzimuth;

    /**
     * One of this class's TILT_* constants
     * @var string|null
     */
    protected $arrayTilt;

    /**
     * @return array
     */
    public function getValuesAsArray()
    {
        return [
            'solar_electric_number_units_sharing_system' => $this->getNumberUnitsSharingSystem(),
            'solar_electric_year' => $this->getYear(),
            'solar_electric_array_azimuth' => $this->getArrayAzimuth(),
            'solar_electric_array_tilt' => $this->getArrayTilt(),
            'solar_electric_capacity_known' => $this->isCapacityKnown(),
            'solar_electric_system_capacity' => $this->getSystemCapacity(),
            'solar_electric_num_panels' => $this->getNumPanels(),
        ];
    }

    /**
     * @return int|null
     */
    public function getNumberUnitsSharingSystem(): ?int
    {
        return $this->numberUnitsSharingSystem;
    }

    /**
     * @param int|null $numberUnitsSharingSystem
     * @return Photovoltaic
     */
    public function setNumberUnitsSharingSystem(?int $numberUnitsSharingSystem): Photovoltaic
    {
        $this->numberUnitsSharingSystem = $numberUnitsSharingSystem;
        return $this;
    }

    /**
     * @return int|null
     */
    public function isCapacityKnown(): ?int
    {
        return $this->capacityKnown;
    }

    /**
     * @param int|null $numPanels
     * @return Photovoltaic
     */
    public function setCapacityKnown(?int $capacityKnown): Photovoltaic
    {
        $this->capacityKnown = $capacityKnown;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getSystemCapacity(): ?float
    {
        return $this->systemCapacity;
    }

    /**
     * @param float|null $systemCapacity
     * @return Photovoltaic
     */
    public function setSystemCapacity(?float $systemCapacity): Photovoltaic
    {
        $this->systemCapacity = $systemCapacity;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumPanels(): ?int
    {
        return $this->numPanels;
    }

    /**
     * @param int|null $numPanels
     * @return Photovoltaic
     */
    public function setNumPanels(?int $numPanels): Photovoltaic
    {
        $this->numPanels = $numPanels;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * @param int|null $year
     * @return Photovoltaic
     */
    public function setYear(?int $year): Photovoltaic
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getArrayAzimuth(): ?string
    {
        return $this->arrayAzimuth;
    }

    /**
     * @param null|string $arrayAzimuth
     * @return Photovoltaic
     */
    public function setArrayAzimuth(?string $arrayAzimuth): Photovoltaic
    {
        $this->arrayAzimuth = $arrayAzimuth;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getArrayTilt(): ?string
    {
        return $this->arrayTilt;
    }

    /**
     * @param null|string $arrayTilt
     * @return Photovoltaic
     */
    public function setArrayTilt(?string $arrayTilt): Photovoltaic
    {
        $this->arrayTilt = $arrayTilt;
        return $this;
    }
}
