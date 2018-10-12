<?php

namespace HESCommon\Models;

/**
 * Class Wall - Stores information about the walls on one side of a building
 */
class Wall extends Model
{
    /** @var string|null */
    protected $assemblyCode;

    /**
     * @param string $count
     * @return array
     */
    public function getValuesAsArray(string $position)
    {
        return ['wall_assembly_code_'.$position => $this->getAssemblyCode()];
    }

    /**
     * @return string
     */
    public function getAssemblyCode(): ?string
    {
        return $this->assemblyCode;
    }

    /**
     * @param string|null $assemblyCode
     * @return Wall
     */
    public function setAssemblyCode(?string $assemblyCode): Wall
    {
        $this->assemblyCode = $assemblyCode;
        return $this;
    }
}
