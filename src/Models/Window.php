<?php

namespace HESCommon\Models;

/**
 * Class Window - Stores information about the windows on one side of a building
 */
class Window extends Model
{
    /** @var bool */
    protected $solarScreen;
    
    /** @var int */
    protected $area;

    /** @var string */
    protected $method;

    /** @var string */
    protected $code;

    /** @var float */
    protected $uValue;

    /** @var float */
    protected $shgc;

    /**
     * @param string $position
     * @return array
     */
    public function getValuesAsArray(string $position) : array
    {
        return [
            'solar_screen_'.$position => $this->hasSolarScreen(),
            'window_area_'.$position => $this->getArea(),
            'window_method_'.$position => $this->getMethod(),
            'window_code_'.$position => $this->getCode(),
            'window_u_value_'.$position => $this->getUValue(),
            'window_shgc_'.$position => $this->getShgc(),
        ];
    }

    /**
     * @return bool|null
     */
    public function hasSolarScreen(): ?int
    {
        return $this->solarScreen;
    }
    
    /**
     * @return bool|null
     */
    public function setSolarScreen($solarScreen): ?int
    {
        $this->solarScreen = $solarScreen;
        return $this;
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
     * @return Window
     */
    public function setArea(?int $area): Window
    {
        $this->area = $area;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @param null|string $method
     * @return Window
     */
    public function setMethod(?string $method): Window
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param null|string $code
     * @return Window
     */
    public function setCode(?string $code): Window
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getUValue(): ?float
    {
        return $this->uValue;
    }

    /**
     * @param float|null $uValue
     * @return Window
     */
    public function setUValue(?float $uValue): Window
    {
        $this->uValue = $uValue;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getShgc(): ?float
    {
        return $this->shgc;
    }

    /**
     * @param float|null $shgc
     * @return Window
     */
    public function setShgc(?float $shgc): Window
    {
        $this->shgc = $shgc;
        return $this;
    }
}
