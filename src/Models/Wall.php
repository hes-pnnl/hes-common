<?php

namespace HESCommon\Models;

/**
 * Class Wall - Stores information about the walls on one side of a building
 */
class Wall extends Model
{
    const ADJACENT_TO_OUTSIDE             = 'outside';
    const ADJACENT_TO_UNIT                = 'other_unit';
    const ADJACENT_TO_HEATED_SPACE        = 'other_heated_space';
    const ADJACENT_TO_BUFFER_SPACE        = 'other_multifamily_buffer_space';
    const ADJACENT_TO_NON_FREEZING_SPACE  = 'other_non_freezing_space';

    /** @var string|null */
    protected $assemblyCode;

    /** 
     * One of the class ADJACENT_TO_* constants
     * 
     * @var string|null 
     * */
    protected $adjacentTo;

    /**
     * @param string $count
     * @return array
     */
    public function getValuesAsArray(string $position)
    {
        return [
            'wall_assembly_code_'.$position => $this->getAssemblyCode(),
            'adjacent_to_'.$position => $this->getAdjacentTo()
        ];
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

    /**
     * @return string
     */
    public function getAdjacentTo(): ?string
    {
        return $this->adjacentTo;
    }

    /**
     * @param string|null $adjacentTo
     * @return Wall
     */
    public function setAdjacentTo(?string $adjacentTo): Wall
    {
        $this->adjacentTo = $adjacentTo;
        return $this;
    }
}
