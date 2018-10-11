<?php

namespace HESCommon\Models;

/**
 * Class Roof - Contains the values for one of a building's roof zones
 */
class Roof
{
    const TYPE_VENTED_ATTIC = 'vented_attic';
    const TYPE_CONDITIONED_ATTIC = 'cond_attic';
    const TYPE_CATHEDRAL_CEILING = 'cath_ceiling';

    /**
     * The footprint of the roof in square feet
     *
     * @var int|null
     */
    protected $area;

    /** @var string|null */
    protected $roofAssemblyCode;

    /** @var string|null */
    protected $color;

    /** @var float|null */
    protected $absorptance;

    /**
     * @var string|null One of this class's TYPE_* constants
     */
    protected $type;

    /** @var string|null */
    protected $ceilingAssemblyCode;

    /** @var int|null */
    protected $skylightArea;

    /** @var string|null */
    protected $skylightMethod;

    /** @var string|null */
    protected $skylightAssemblyCode;

    /** @var float|null */
    protected $skylightUValue;

    /** @var float|null */
    protected $skylightShgc;

    /**
     * @param int $count
     * @return array
     */
    public function getValuesAsArray(int $count)
    {
        $values = [
            'roof_area_'.$count => $this->getArea(),
            'roof_type_'.$count => $this->getType(),
            'roof_assembly_code_'.$count => $this->getRoofAssemblyCode(),
            'roof_color_'.$count => $this->getColor(),
            'roof_absorptance_'.$count => $this->getAbsorptance(),
            'ceiling_assembly_code_'.$count => $this->getCeilingAssemblyCode(),
        ];
        //Skylight
        if($count == 1) {
            $values['skylight_area'] = $this->getSkylightArea();
            $values['skylight_method'] = $this->getSkylightMethod();
            $values['skylight_code'] = $this->getSkylightAssemblyCode();
            $values['skylight_u_value'] = $this->getSkylightUValue();
            $values['skylight_shgc'] = $this->getSkylightShgc();
        }
        
        return $values;
    }

    /**
     * @return int|null
     */
    public function getArea(): ?int
    {
        return $this->area;
    }

    /**
     * @param int|null $area
     * @return Roof
     */
    public function setArea(?int $area): Roof
    {
        $this->area = $area;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getRoofAssemblyCode(): ?string
    {
        return $this->roofAssemblyCode;
    }

    /**
     * @param null|string $roofAssemblyCode
     * @return Roof
     */
    public function setRoofAssemblyCode(?string $roofAssemblyCode): Roof
    {
        $this->roofAssemblyCode = $roofAssemblyCode;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param null|string $color
     * @return Roof
     */
    public function setColor(?string $color): Roof
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getAbsorptance(): ?float
    {
        return $this->absorptance;
    }

    /**
     * @param float|null $absorptance
     * @return Roof
     */
    public function setAbsorptance(?float $absorptance): Roof
    {
        $this->absorptance = $absorptance;
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
     * @return Roof
     */
    public function setType(?string $type): Roof
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCeilingAssemblyCode(): ?string
    {
        return $this->ceilingAssemblyCode;
    }

    /**
     * @param null|string $ceilingAssemblyCode
     * @return Roof
     */
    public function setCeilingAssemblyCode(?string $ceilingAssemblyCode): Roof
    {
        $this->ceilingAssemblyCode = $ceilingAssemblyCode;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSkylightArea(): ?int
    {
        return $this->skylightArea;
    }

    /**
     * @param int|null $skylightArea
     * @return Roof
     */
    public function setSkylightArea(?int $skylightArea): Roof
    {
        $this->skylightArea = $skylightArea;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getSkylightMethod(): ?string
    {
        return $this->skylightMethod;
    }

    /**
     * @param null|string $skylightMethod
     * @return Roof
     */
    public function setSkylightMethod(?string $skylightMethod): Roof
    {
        $this->skylightMethod = $skylightMethod;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getSkylightAssemblyCode(): ?string
    {
        return $this->skylightAssemblyCode;
    }

    /**
     * @param null|string $skylightAssemblyCode
     * @return Roof
     */
    public function setSkylightAssemblyCode(?string $skylightAssemblyCode): Roof
    {
        $this->skylightAssemblyCode = $skylightAssemblyCode;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getSkylightUValue(): ?float
    {
        return $this->skylightUValue;
    }

    /**
     * @param float|null $skylightUValue
     * @return Roof
     */
    public function setSkylightUValue(?float $skylightUValue): Roof
    {
        $this->skylightUValue = $skylightUValue;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getSkylightShgc(): ?float
    {
        return $this->skylightShgc;
    }

    /**
     * @param float|null $skylightShgc
     * @return Roof
     */
    public function setSkylightShgc(?float $skylightShgc): Roof
    {
        $this->skylightShgc = $skylightShgc;
        return $this;
    }
}