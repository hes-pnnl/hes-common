<?php

namespace HESCommon\Models;


/**
 * Class Floor - Contains the values for one of a building's floor zones.
 *
 * Note that a "floor" in the nomenclature of the API is actually a foundation, not a floor in the sense of a story or
 * the home's room flooring.
 */
class Floor extends Model
{
    const TYPE_UNCONDITIONED_BASEMENT = 'uncond_basement';
    const TYPE_CONDITIONED_BASEMENT   = 'cond_basement';
    const TYPE_VENTED_CRAWL           = 'vented_crawl';
    const TYPE_UNVENTED_CRAWL         = 'unvented_crawl';
    const TYPE_SLAB_ON_GRADE          = 'slab_on_grade';
    const TYPE_ABOVE_UNIT             = 'above_other_unit';
    const TYPE_BELLY_AND_WING         = 'belly_and_wing';

    /** @var float|null */
    protected $area;

    /** @var string|null One of this class's TYPE_* constants */
    protected $type;

    /** @var int|null */
    protected $insulationLevel;

    /** @var string|null */
    protected $assemblyCode;

    /**
     * @param int $count
     * @return array
     */
    public function getValuesAsArray(int $count)
    {
        return [
            'floor_area_'.$count => $this->getArea(),
            'foundation_type_'.$count => $this->getType(),
            'floor_assembly_code_'.$count => $this->getAssemblyCode(),
            'foundation_insulation_level_'.$count => $this->getInsulationLevel(),
        ];
    }

    /**
     * @return float|null
     */
    public function getArea(): ?float
    {
        return $this->area;
    }

    /**
     * @param float|null $area
     * @return Floor
     */
    public function setArea(?float $area): Floor
    {
        $this->area = $area;
        return $this;
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
     * @return Floor
     */
    public function setType(?string $type): Floor
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getInsulationLevel(): ?int
    {
        return $this->insulationLevel;
    }

    /**
     * @param int|null $insulationLevel
     * @return Floor
     */
    public function setInsulationLevel(?int $insulationLevel): Floor
    {
        $this->insulationLevel = $insulationLevel;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getAssemblyCode(): ?string
    {
        return $this->assemblyCode;
    }

    /**
     * @param null|string $assemblyCode
     * @return Floor
     */
    public function setAssemblyCode(?string $assemblyCode): Floor
    {
        $this->assemblyCode = $assemblyCode;
        return $this;
    }
}
