<?php

namespace HESCommon\Models;

use HESCommon\Services\BooleanService;

class Building extends Model
{
    const SHAPE_RECTANGLE = 'rectangle';
    const SHAPE_TOWNHOUSE = 'town_house';

    const TOWNHOUSE_POSITION_LEFT   = 'back_right_front';
    const TOWNHOUSE_POSITION_MIDDLE = 'back_front';
    const TOWNHOUSE_POSITION_RIGHT  = 'back_front_left';

    const ORIENTATION_NORTH     = 'north';
    const ORIENTATION_SOUTH     = 'south';
    const ORIENTATION_EAST      = 'east';
    const ORIENTATION_WEST      = 'west';
    const ORIENTATION_NORTHEAST = 'north_east';
    const ORIENTATION_NORTHWEST = 'north_west';
    const ORIENTATION_SOUTHEAST = 'south_east';
    const ORIENTATION_SOUTHWEST = 'south_west';

    const ASSESSMENT_TYPE_INITIAL         = 'initial';
    const ASSESSMENT_TYPE_FINAL           = 'final';
    const ASSESSMENT_TYPE_QA              = 'qa';
    const ASSESSMENT_TYPE_ALTERNATIVE_EEM = 'alternative';
    const ASSESSMENT_TYPE_TEST            = 'test';
    const ASSESSMENT_TYPE_CORRECTED       = 'corrected';
    const ASSESSMENT_TYPE_MENTOR          = 'mentor';
    const ASSESSMENT_TYPE_PRECONSTRUCTION = 'preconstruction';
    const ASSESSMENT_TYPE_VOID            = 'void';

    const ASSESSMENT_TYPES = [
        self::ASSESSMENT_TYPE_INITIAL,
        self::ASSESSMENT_TYPE_FINAL,
        self::ASSESSMENT_TYPE_QA,
        self::ASSESSMENT_TYPE_ALTERNATIVE_EEM,
        self::ASSESSMENT_TYPE_TEST,
        self::ASSESSMENT_TYPE_CORRECTED,
        self::ASSESSMENT_TYPE_MENTOR,
        self::ASSESSMENT_TYPE_PRECONSTRUCTION,
        self::ASSESSMENT_TYPE_VOID
    ];

    const OFFICIAL_TYPES = [
        self::ASSESSMENT_TYPE_INITIAL,
        self::ASSESSMENT_TYPE_CORRECTED,
        self::ASSESSMENT_TYPE_FINAL
    ];

    /** @var int */
    protected $id;

    /** @var int|null */
    protected $parentId;

    /** @var int|null */
    protected $ultimateAncestorId;

    /** @var string|null */
    protected $externalBuildingId;

    /** @var \DateTime */
    protected $assessmentDate;

    /** @var string */
    protected $assessmentType;

    /** @var string */
    protected $comments;

    /**
     * One of this class's SHAPE_* constants
     *
     * @var string
     */
    protected $shape;

    /**
     * One of this class's TOWNHOUSE_POSITION_* constants
     * @var string
     */
    protected $townhousePosition;

    /** @var int */
    protected $yearBuilt;

    /** @var int */
    protected $numberBedrooms;

    /** @var int */
    protected $floorsAboveGrade;

    /**
     * Floor-to-ceiling height of the home in feet
     * @var int
     */
    protected $floorToCeilingHeight;

    /**
     * Total conditioned floor area of the home in square feet
     * @var int
     */
    protected $conditionedFloorArea;

    /**
     * One of this class's ORIENTATION_* constants
     * @var string
     */
    protected $orientation;

    /** @var bool */
    protected $wasBlowerTestPerformed;

    /** @var bool */
    protected $isAirSealingPresent;

    /** @var int */
    protected $envelopeLeakage;

    /** @var bool */
    protected $isWallConstructionSameOnAllSides;

    /** @var bool */
    protected $isWindowConstructionSameOnAllSides;

    /** @var Roof[] */
    protected $roofs = [];

    /** @var Floor[] */
    protected $floors = [];

    /** @var Wall[] */
    protected $walls = [];

    /** @var Window[] */
    protected $windows = [];

    /** @var Hvac[] */
    protected $hvacs = [];

    /** @var Address */
    protected $address;

    /** @var HPwES */
    protected $HPwES;

    /** @var HotWater */
    protected $hotWater;

    /** @var Photovoltaic */
    protected $photovoltaic;

    public function __construct(int $id)
    {
        $this->id = $id;
        $this->roofs = [ 1 => new Roof(), 2 => new Roof() ];
        $this->floors = [ 1 => new Floor(), 2 => new Floor() ];
        $this->hvacs = [ 1 => new Hvac(), 2 => new Hvac() ];

        $this->walls = [];
        $this->windows = [];
        foreach (['front', 'back', 'left', 'right'] as $side) {
            $this->walls[$side] = new Wall();
            $this->windows[$side] = new Window();
        }

        $this->HPwES = new HPwES();
        $this->hotWater = new HotWater();
        $this->photovoltaic = new Photovoltaic();
        $this->address = new Address();
    }

    /**
     * @return array
     */
    public function getValuesForValidation()
    {
        $boolService = BooleanService::getInstance();
        $values = [
            'assessment_date' => $this->getAssessmentDate() !== null ? $this->getAssessmentDate()->format('Y-m-d') : null,
            'comments' => $this->getComments(),
            'year_built' => $this->getYearBuilt(),
            'number_bedrooms' => $this->getNumberBedrooms(),
            'num_floor_above_grade' => $this->getFloorsAboveGrade(),
            'floor_to_ceiling_height' => $this->getFloorToCeilingHeight(),
            'conditioned_floor_area' => $this->getConditionedFloorArea(),
            'orientation' => $this->getOrientation(),
            'blower_door_test' => $boolService->getIntValForThreeValueBoolean($this->wasBlowerTestPerformed()),
            'air_sealing_present' => $boolService->getIntValForThreeValueBoolean($this->isAirSealingPresent()),
            'envelope_leakage' => $this->getEnvelopeLeakage(),
            //Walls
            'shape' => $this->getShape(),
            'town_house_walls' => $this->getTownhousePosition(),
            'wall_construction_same' => $boolService->getIntValForThreeValueBoolean($this->isWallConstructionSameOnAllSides()),
            //Windows
            'window_construction_same' => $boolService->getIntValForThreeValueBoolean($this->isWindowConstructionSameOnAllSides()),
        ];

        $roofValues = [];
        foreach([1,2] as $count) {
            $roof = $this->getRoof($count);
            $roofValues = array_merge($roofValues, $roof->getValuesAsArray($count));
        }
        $floorValues = [];
        foreach([1,2] as $count) {
            $floor = $this->getFloor($count);
            $floorValues = array_merge($floorValues, $floor->getValuesAsArray($count));
        }
        $positions = ['front', 'back', 'right', 'left'];
        $wallValues = [];
        foreach($positions as $position) {
            $wall = $this->getWall($position);
            $wallValues = array_merge($wallValues, $wall->getValuesAsArray($position));
        }
        $windowValues = [];
        foreach($positions as $position) {
            $window = $this->getWindow($position);
            $windowValues = array_merge($windowValues, $window->getValuesAsArray($position));
        }
        $hvacValues = [];
        $ductValues = [];
        foreach([1,2] as $system){
            $hvac = $this->getHvac($system);
            $hvacValues = array_merge($hvacValues, $hvac->getValuesAsArray($system));
            foreach([1,2,3] as $count) {
                $duct = $hvac->getDuct($count);
                $ductValues = array_merge($ductValues, $duct->getValuesAsArray($system, $count));
            }
        }
        $hw = $this->getHotWater();
        $hwValues = $hw->getValuesAsArray();
        $pv = $this->getPhotovoltaic();
        $pvValues = $pv->getValuesAsArray();

        $values = array_merge(
            $values,
            $roofValues,
            $floorValues,
            $wallValues,
            $windowValues,
            $hvacValues,
            $ductValues,
            $hwValues,
            $pvValues
        );

        return $values;
    }

    /**
     * @return int
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getParentId() : ?int
    {
        return $this->parentId;
    }

    /**
     * @return int|null
     */
    public function getUltimateAncestorId() : ?int
    {
        return $this->ultimateAncestorId;
    }

    /**
     * @return null|string
     */
    public function getExternalBuildingId(): ?string
    {
        return $this->externalBuildingId;
    }

    /**
     * @param null|string $externalBuildingId
     * @return Building
     */
    public function setExternalBuildingId(?string $externalBuildingId): Building
    {
        $this->externalBuildingId = $externalBuildingId;
        return $this;
    }

    /**
     * @return string One of this class's ASSESSMENT_TYPE_* constants
     */
    public function getAssessmentType() : ?string
    {
        return $this->assessmentType;
    }

    /**
     * @param string $assessmentType One of this class's ASSESSMENT_TYPE_* constants
     * @return string
     */
    public function setAssessmentType(string $assessmentType)
    {
        if (!in_array($assessmentType, self::ASSESSMENT_TYPES)) {
            throw new \InvalidArgumentException("$assessmentType is not a valid assessment type");
        }
        $this->assessmentType = $assessmentType;
    }

    /**
     * @return \DateTime|null
     */
    public function getAssessmentDate(): ?\DateTime
    {
        return $this->assessmentDate;
    }

    /**
     * @param \DateTime|null $assessmentDate
     * @return Building
     */
    public function setAssessmentDate(?\DateTime $assessmentDate): Building
    {
        $this->assessmentDate = $assessmentDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getComments(): ?string
    {
        return $this->comments;
    }

    /**
     * @param string|null $comments
     * @return Building
     */
    public function setComments(?string $comments): Building
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getShape(): ?string
    {
        return $this->shape;
    }

    /**
     * @param string|null $shape
     * @return Building
     */
    public function setShape(?string $shape): Building
    {
        $this->shape = $shape;
        return $this;
    }

    /**
     * Convenience function to check whether the building's shape is SHAPE_TOWNHOUSE
     * @return bool
     */
    public function isTownhouse() : bool
    {
        return $this->getShape() === self::SHAPE_TOWNHOUSE;
    }

    /**
     * @return string|null
     */
    public function getTownhousePosition(): ?string
    {
        return $this->townhousePosition;
    }

    /**
     * @param string|null $townhousePosition
     * @return Building
     */
    public function setTownhousePosition(?string $townhousePosition): Building
    {
        $this->townhousePosition = $townhousePosition;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getYearBuilt(): ?int
    {
        return $this->yearBuilt;
    }

    /**
     * @param int|null $yearBuilt
     * @return Building
     */
    public function setYearBuilt(?int $yearBuilt): Building
    {
        $this->yearBuilt = $yearBuilt;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumberBedrooms(): ?int
    {
        return $this->numberBedrooms;
    }

    /**
     * @param int|null $numberBedrooms
     * @return Building
     */
    public function setNumberBedrooms(?int $numberBedrooms): Building
    {
        $this->numberBedrooms = $numberBedrooms;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getFloorsAboveGrade(): ?int
    {
        return $this->floorsAboveGrade;
    }

    /**
     * @param int|null $floorsAboveGrade
     * @return Building
     */
    public function setFloorsAboveGrade(?int $floorsAboveGrade): Building
    {
        $this->floorsAboveGrade = $floorsAboveGrade;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getFloorToCeilingHeight(): ?int
    {
        return $this->floorToCeilingHeight;
    }

    /**
     * @param int|null $floorToCeilingHeight
     * @return Building
     */
    public function setFloorToCeilingHeight(?int $floorToCeilingHeight): Building
    {
        $this->floorToCeilingHeight = $floorToCeilingHeight;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getConditionedFloorArea(): ?int
    {
        return $this->conditionedFloorArea;
    }

    /**
     * @param int|null $conditionedFloorArea
     * @return Building
     */
    public function setConditionedFloorArea(?int $conditionedFloorArea): Building
    {
        $this->conditionedFloorArea = $conditionedFloorArea;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOrientation(): ?string
    {
        return $this->orientation;
    }

    /**
     * @param string|null $orientation
     * @return Building
     */
    public function setOrientation(?string $orientation): Building
    {
        $this->orientation = $orientation;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function wasBlowerTestPerformed(): ?bool
    {
        return $this->wasBlowerTestPerformed;
    }

    /**
     * @param bool|null $wasBlowerTestPerformed
     * @return Building
     */
    public function setWasBlowerTestPerformed(?bool $wasBlowerTestPerformed): Building
    {
        $this->wasBlowerTestPerformed = $wasBlowerTestPerformed;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isAirSealingPresent(): ?bool
    {
        return $this->isAirSealingPresent;
    }

    /**
     * @param bool|null $isAirSealingPresent
     * @return Building
     */
    public function setIsAirSealingPresent(?bool $isAirSealingPresent): Building
    {
        $this->isAirSealingPresent = $isAirSealingPresent;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getEnvelopeLeakage(): ?int
    {
        return $this->envelopeLeakage;
    }

    /**
     * @param int|null $envelopeLeakage
     * @return Building
     */
    public function setEnvelopeLeakage(?int $envelopeLeakage): Building
    {
        $this->envelopeLeakage = $envelopeLeakage;
        return $this;
    }

    /**
     * @return HPwES|null
     */
    public function getHPwES() : ?HPwES
    {
        return $this->HPwES;
    }

    /**
     * @param HPwES|null $HPwES
     * @return Building
     */
    public function setHPwES(?HPwES $HPwES) : Building
    {
        $this->HPwES = $HPwES;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isWallConstructionSameOnAllSides(): ?bool
    {
        return $this->isWallConstructionSameOnAllSides;
    }

    /**
     * @param bool|null $isWallConstructionSameOnAllSides
     * @return Building
     */
    public function setIsWallConstructionSameOnAllSides(?bool $isWallConstructionSameOnAllSides): Building
    {
        $this->isWallConstructionSameOnAllSides = $isWallConstructionSameOnAllSides;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isWindowConstructionSameOnAllSides(): ?bool
    {
        return $this->isWindowConstructionSameOnAllSides;
    }

    /**
     * @param bool|null $isWindowConstructionSameOnAllSides
     * @return Building
     */
    public function setIsWindowConstructionSameOnAllSides(?bool $isWindowConstructionSameOnAllSides): Building
    {
        $this->isWindowConstructionSameOnAllSides = $isWindowConstructionSameOnAllSides;
        return $this;
    }

    /**
     * @throws \InvalidArgumentException
     * @param int $roofNumber
     * @return Roof
     */
    public function getRoof(int $roofNumber) : Roof
    {
        if (!isset($this->roofs[$roofNumber])) {
            throw new \InvalidArgumentException("Roof $roofNumber does not exist");
        }

        return $this->roofs[$roofNumber];
    }

    /**
     * @return Roof[]
     */
    public function getRoofs() : array
    {
        return $this->roofs;
    }

    /**
     * @throws \InvalidArgumentException
     * @param int $floorNumber
     * @return Floor
     */
    public function getFloor(int $floorNumber) : Floor
    {
        if (!isset($this->floors[$floorNumber])) {
            throw new \InvalidArgumentException("Floor $floorNumber does not exist");
        }

        return $this->floors[$floorNumber];
    }

    /**
     * @throws \InvalidArgumentException
     * @param string $side
     * @return Wall
     */
    public function getWall(string $side) : Wall
    {
        if (!isset($this->walls[$side])) {
            throw new \InvalidArgumentException("$side is not a valid side");
        }

        return $this->walls[$side];
    }

    /**
     * @return array in the form ['front' => Wall, 'back' => Wall, 'left' => Wall, 'right' => Wall]
     */
    public function getWalls() : array
    {
        return $this->walls;
    }

    /**
     * @throws \InvalidArgumentException
     * @param string $side
     * @return Window
     */
    public function getWindow(string $side) : Window
    {
        if (!isset($this->windows[$side])) {
            throw new \InvalidArgumentException("$side is not a valid side");
        }

        return $this->windows[$side];
    }

    /**
     * @return array in the form ['front' => Window, 'back' => Window, 'left' => Window, 'right' => Window]
     */
    public function getWindows() : array
    {
        return $this->windows;
    }

    /**
     * @param int $hvacNumber
     * @return Hvac
     */
    public function getHvac(int $hvacNumber) : Hvac
    {
        if (!isset($this->hvacs[$hvacNumber])) {
            throw new \InvalidArgumentException("$hvacNumber is not a valid hvac number");
        }

        return $this->hvacs[$hvacNumber];
    }

    /**
     * @return Address
     */
    public function getAddress() : Address
    {
        return $this->address;
    }

    /**
     * @return HotWater
     */
    public function getHotWater() : HotWater
    {
        return $this->hotWater;
    }

    /**
     * @return Photovoltaic
     */
    public function getPhotovoltaic() : Photovoltaic
    {
        return $this->photovoltaic;
    }

    /**
     * Returns true if this building assessment is considered "official" based on its assessment type
     * @return bool
     */
    public function isOfficial() : bool
    {
        return in_array($this->getAssessmentType(), self::OFFICIAL_TYPES);
    }
}
