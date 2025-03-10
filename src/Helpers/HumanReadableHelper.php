<?php

namespace HESCommon\Helpers;

use HESCommon\Models\Building;
use HESCommon\Models\Duct;
use HESCommon\Models\HotWater;
use HESCommon\Models\Hvac;
use HESCommon\Models\Roof;
use HESCommon\Models\Wall;

/**
 * HumanReadableHelper is used to convert the machine/api recognizable fields and values in our
 * Building models to the human readable versions in our GUI and Label.
 */

class HumanReadableHelper extends Helper
{
    const ASSESSMENT_TYPES = [
        'initial'         => 'Initial',
        'final'           => 'Final',
        'qa'              => 'QA',
        'alternative'     => 'Alternative EEM',
        'test'            => 'Test',
        'corrected'       => 'Corrected',
        'mentor'          => 'Mentor',
        'preconstruction' => 'Preconstruction',
        'void'            => 'Void'
    ];

    const DWELLING_UNIT = [
        Building::DWELLING_UNIT_SINGLE_DETACHED => "Single-Family Detached",
        Building::DWELLING_UNIT_SINGLE_ATTACHED => "Townhouse/Rowhouse/Duplex",
        Building::DWELLING_UNIT_APARTMENT       => "Multifamily Building Unit",
        Building::DWELLING_UNIT_MANUFACTURED    => "Manufactured Home"
    ];
    
    const MANUFACTURED_HOME_SECTION = [
        Building::MANUFACTURED_HOME_SECTION_SINGLE => "Single-Wide",
        Building::MANUFACTURED_HOME_SECTION_DOUBLE => "Double-Wide",
        Building::MANUFACTURED_HOME_SECTION_TRIPLE => "Triple-Wide"
    ];
    
    // Fields that designate areas - we will append 'sq ft' to the end of their values
    const AREA_FIELDS = [
        'condiditioned_floor_area',
        'roof_area_1',
        'roof_area_2',
        'floor_area_1',
        'floor_area_2',
        'skylight_area',
        'window_area_front',
        'window_area_back',
        'window_area_left',
        'window_area_right'
    ];
    
    /* Wall Codes */
    const EXTERIOR_CONSTRUCTION_WALL = [
        "ewwf"=>"Wood Frame",
        "ewps"=>"Wood Frame with rigid foam sheathing",
        "ewov"=>"Wood Frame with Optimum Value Engineering (OVE)",
        "ewbr"=>"Structural Brick",
        "ewcb"=>"Concrete Block or Stone",
        "ewsb"=>"Straw Bale",
        "ewsf"=>"Steel Frame",
    ];

    const CONSTRUCTION_WALL =[
        "ewwf"=>"Wood Frame",
        "ewps"=>"Wood Frame with rigid foam sheathing",
        "ewov"=>"Wood Frame with Optimum Value Engineering (OVE)",
        "ewbr"=>"Structural Brick",
        "ewcb"=>"Concrete Block or Stone",
        "ewsb"=>"Straw Bale",
        "ewsf"=>"Steel Frame",
        "iwwf"=>"Inner Wall"
    ];
    const FINISH = [
        "wo"=>"Wood Siding, Fiber Cement, Composite Shingle, or Masonite Siding",
        "st"=>"Stucco",
        "vi"=>"Vinyl Siding",
        "al"=>"Aluminum Siding",
        "br"=>"Brick Veneer",
        "nn"=>"None"
    ];
    const INSULATION_WALL = [
        "00"=>"R-0",
        "03"=>"R-3",
        "05"=>"R-5",
        "06"=>"R-6",
        "07"=>"R-7",
        "10"=>"R-10",
        "11"=>"R-11",
        "13"=>"R-13",
        "15"=>"R-15",
        "19"=>"R-19",
        "21"=>"R-21",
        "25"=>"R-25",
        "27"=>"R-27",
        "33"=>"R-33",
        "35"=>"R-35",
        "38"=>"R-38",
    ];
    
    /* Window Codes */
    const PANES = [
        's'=>'Single-Pane',
        'd'=>'Double-Pane',
        't'=>'Triple-Pane'
    ];
    const FRAME = [
        'a' => 'Aluminum',
        'w' => 'Wood or Vinyl',
        'b' => 'Aluminum with Thermal Break'
    ];
    const GLAZING = [
        'cn' => 'Clear',
        'tn' => 'Tinted',
        'ca' => 'Clear',
        'ta' => 'Tinted',
        'sea' => 'Solar-Control low-E',
        'peaa' => 'Insulating low-E, argon gas fill',
        'seaa' => 'Solar-Control low-E, argon gas fill',
        'pea' => 'Insulating low-E',
        'hmab' => 'Insulating low-E, argon gas fill'
    ];
    
    /* Roof Codes */
    const CONSTRUCTION_ROOF = [
        "rfwf"=>"Standard Roof",
        "rfrb"=>"Roof with Radiant Barrier",
        "rfps"=>"Roof with Rigid Foam Sheathing"
    ];
    const EXTERIOR = [
        "co"=>"Composition Shingles or Metal",
        "wo"=>"Wood Shakes",
        "rc"=>"Clay Tile",
        "lc"=>"Concrete Tile",
        "tg"=>"Tar or Gravel"
    ];
    const INSULATION_ROOF = [
        "00"=>"R-0",
        "03"=>"R-3",
        "07"=>"R-7",
        "11"=>"R-11",
        "13"=>"R-13",
        "15"=>"R-15",
        "19"=>"R-19",
        "21"=>"R-21",
        "25"=>"R-25",
        "27"=>"R-27",
        "30"=>"R-30",
    ];
    const ATTIC_TYPE = [
        Roof::TYPE_VENTED_ATTIC => "Unconditioned Attic",
        Roof::TYPE_CONDITIONED_ATTIC => "Conditioned Attic",
        Roof::TYPE_BELOW_UNIT => "Below other Unit",
        Roof::TYPE_CATHEDRAL_BOWSTRING => "Bowstring Roof",
        Roof::TYPE_CATHEDRAL_FLAT => "Flat Roof",
        Roof::TYPE_CATHEDRAL_CEILING => "Cathedral Ceiling"
    ];
    const ATTIC_INSULATION = [
        "ecwf00" => "R-0",
        "ecwf03" => "R-3",
        "ecwf06" => "R-6",
        "ecwf09" => "R-9",
        "ecwf11" => "R-11",
        "ecwf13" => "R-13",
        "ecwf15" => "R-15",
        "ecwf19" => "R-19",
        "ecwf21" => "R-21",
        "ecwf25" => "R-25",
        "ecwf30" => "R-30",
        "ecwf35" => "R-35",
        "ecwf38" => "R-38",
        "ecwf44" => "R-44",
        "ecwf49" => "R-49",
        "ecwf55" => "R-55",
        "ecwf60" => "R-60"
    ];
    const KNEE_WALL_ASSEMBLY = [
        "kwwf00" => "R-0",
        "kwwf03" => "R-3",
        "kwwf07" => "R-7",
        "kwwf11" => "R-11",
        "kwwf13" => "R-13",
        "kwwf15" => "R-15",
        "kwwf19" => "R-19",
        "kwwf21" => "R-21"
    ];

    /* Foundation Codes */
    const FOUNDATION_TYPE = [
        ""=>"-Select-",
        "slab_on_grade"=>"Slab-on-grade foundation",
        "uncond_basement"=>"Unconditioned Basement",
        "cond_basement"=>"Conditioned Basement",
        "unvented_crawl"=>"Unvented Crawlspace",
        "vented_crawl"=>"Vented Crawlspace",
        "belly_and_wing"=>"Belly and Wing",
        "above_other_unit"=>"Above Other Unit"
    ];
    const INSULATION_FLOOR = [
        ""=>"-Select-",
        "efwf00ca"=>"R-0",
        "efwf03ca"=>"R-3",
        "efwf07ca"=>"R-7",
        "efwf11ca"=>"R-11",
        "efwf13ca"=>"R-13",
        "efwf15ca"=>"R-15",
        "efwf19ca"=>"R-19",
        "efwf21ca"=>"R-21",
        "efwf25ca"=>"R-25",
        "efwf30ca"=>"R-30",
        "efwf35ca"=>"R-35",
        "efwf38ca"=>"R-38",
        "efbw00"=>"R-0",
        "efbw11"=>"R-11",
        "efbw13"=>"R-13",
        "efbw19"=>"R-19",
        "efbw22"=>"R-22",
        "efbw30"=>"R-30"
    ];
    const FOUNDATION_INSULATION = [
        "0"=>"R-0",
        "5"=>"R-5",
        "11"=>"R-11",
        "19"=>"R-19",
    ];
    const ADJACENT_WALL = [
        Wall::ADJACENT_TO_OUTSIDE => "Outside",
        Wall::ADJACENT_TO_UNIT => "Other Unit",
        Wall::ADJACENT_TO_HEATED_SPACE => "Other Heated Space",
        Wall::ADJACENT_TO_NON_FREEZING_SPACE => "Other Non-Freezing Space",
        Wall::ADJACENT_TO_BUFFER_SPACE => "Other Multi-Family Buffer Space"
    ];
    
    /* HVAC System Codes */
    const HEATING_TYPE = [
        'none' => 'None',
        'central_furnace' => 'Central furnace',
        'wall_furnace' => 'Room (through-the-wall) furnace',
        'boiler' => 'Boiler',
        'heat_pump' => 'Heat Pump',
        'baseboard' => 'Baseboard Heater',
        'gchp' => 'Ground Coupled Heat Pump',
        'mini_split' => 'Minisplit (ductless) heat pump',
        'wood_stove' => 'Wood Stove',
    ];
    const HEATING_FUEL = [
        'natural_gas' => 'Gas',
        'lpg' => 'Propane (LPG)',
        'fuel_oil' => 'Oil',
        'electric' => 'Electric',
        'cord_wood' => 'Wood',
        'pellet_wood' => 'Pellets',
    ];
    const HEATING_EFFICIENCY_UNIT = [
        Hvac::HEATING_EFFICIENCY_UNIT_AFUE    => "Annual Fuel Utilization Efficiency (AFUE)",
        Hvac::HEATING_EFFICIENCY_UNIT_COP     => "Coefficient of Performance (COP)",
        Hvac::HEATING_EFFICIENCY_UNIT_HSPF    => "Heating Seasonal Performance Factor - Pre 2023 (HSPF)",
        Hvac::HEATING_EFFICIENCY_UNIT_HSPF2   => "Heating Seasonal Performance Factor (HSPF2)"
    ];
    const COOLING_EFFICIENCY_UNIT = [
        Hvac::COOLING_EFFICIENCY_UNIT_EER     => "Energy Efficiency Ratio (EER)",
        Hvac::COOLING_EFFICIENCY_UNIT_CEER    => "Combined Energy Efficiency Ratio (CEER)",
        Hvac::COOLING_EFFICIENCY_UNIT_SEER    => "Seasonal Energy Efficiency Ratio - Pre 2023 (SEER)",
        Hvac::COOLING_EFFICIENCY_UNIT_SEER2   => "Seasonal Energy Efficiency Ratio (SEER2)"
    ];
    const HOT_WATER_EFFICIENCY_UNIT = [
        HotWater::EFFICIENCY_UNIT_EF    => "Energy Factor (EF)",
        HotWater::EFFICIENCY_UNIT_UEF   => "Uniform Energy Factor (UEF)"
    ];
    const COOLING_TYPE = [
        "none"        => "None",
        "split_dx"    => "Central air conditioner",
        "packaged_dx" => "Room air conditioner",
        "heat_pump"   => "Electric heat pump",
        "mini_split"  => "Minisplit (ductless) heat pump",
        "gchp"        => "Ground coupled heat pump",
        "dec"         => "Direct evaporative cooling"
    ];
    const DUCT_LOCATION = [
        Duct::LOCATION_CONDITIONED_SPACE      => "Conditioned space",
        Duct::LOCATION_UNCONDITIONED_BASEMENT => "Unconditioned basement",
        Duct::LOCATION_VENTED_CRAWLSPACE      => "Vented crawlspace",
        Duct::LOCATION_UNVENTED_CRAWLSPACE    => "Unvented crawlspace / Unconditioned garage",
        Duct::LOCATION_UNCONDITIONED_ATTIC    => "Unconditioned attic",
        Duct::LOCATION_UNDER_SLAB             => 'Under slab',
        Duct::LOCATION_EXTERIOR_WALL          => 'In exterior wall',
        Duct::LOCATION_OUTSIDE                => 'Outside',
        Duct::LOCATION_BELLY                  => 'Manufactured Home Belly'
    ];
    const HOT_WATER_TYPE = [
        "storage"           => "Storage",
        "heat_pump"         => "Heat Pump",
        "indirect"          => "Indirect Tank",
        "tankless_coil"     => "Tankless Coil",
        "tankless"          => "Instantaneous"
    ];
    const HOT_WATER_FUEL = [
        "electric"      => "Electric",
        "natural_gas"   => "Natural Gas",
        "lpg"           => "Propane (LPG)",
        "fuel_oil"      => "Oil",
        "electric"      => "Electric"
    ];
    
    /**
     * @param string|null $assemblyCode
     * @return string|null
     */
    public static function getWallAssembly($assemblyCode) : ?string
    {
        if($assemblyCode !== null) {
            $assembly = self::CONSTRUCTION_WALL[substr($assemblyCode, 0, 4)];
            if(strlen($assemblyCode) > 6) {
                $assembly .= "/" . self::FINISH[substr($assemblyCode, 6, 2)];
            }
            $assembly .= "/".self::INSULATION_WALL[substr($assemblyCode, 4, 2)];
            return $assembly;
        }
        return null;
    }
    
    /**
     * @param string|null $assemblyCode
     * @return string|null
     */
    public static function getWindowAssembly($assemblyCode) : ?string
    {
        if($assemblyCode !== null) {
            $assembly = self::PANES[substr($assemblyCode, 0, 1)];
            $assembly .= "/".self::FRAME[substr($assemblyCode, -1, 1)];
            $assembly .= "/".self::GLAZING[substr($assemblyCode, 1, -1)];
            return $assembly;
        }
        return null;
    }
    
    /**
     * @param string|null $assemblyCode
     * @return string|null
     */
    public static function getRoofAssembly($assemblyCode) : ?string
    {
        if($assemblyCode !== null) {
            $assembly = self::CONSTRUCTION_ROOF[substr($assemblyCode, 0, 4)];
            $assembly .= "/".self::EXTERIOR[substr($assemblyCode, 6, 2)];
            $assembly .= "/".self::INSULATION_ROOF[substr($assemblyCode, 4, 2)];
            return $assembly;
        }
        return null;
    }

    /**
     * @param array $values hash of building values where name => value
     * @return array entered array returned with human readable values
     */
    public static function nameAndValueToHumanReadable(array $values) : array
    {
        $return = [];
        foreach($values as $name => $value) {
            // Check if name is of indexed field (ie, Roof, Foundation, Systems, Ducts)
            $pos_1 = strpos($name, '_1') ?: strlen($name);
            $pos_2 = strpos($name, '_2') ?: strlen($name);
            $pos_3 = strpos($name, '_3') ?: strlen($name);
            $index = min($pos_1, $pos_2, $pos_3);
            $name = substr($name, 0, $index);
            
            $intToBoolFields = [
                'blower_door_test',
                'air_sealing_present',
                'wall_construction_same',
                'window_construction_same',
                'duct_insulated',
                'duct_sealed'
            ];
            
            if ($name === 'num_floor_above_grade') {
                $newName = 'Stories Above Ground Level';
            } else if ($name === 'floor_to_ceiling_height') {
                $newValue = $value + ' feet';
            } else if (in_array($name, self::AREA_FIELDS)) {
                $newValue = $value + ' sq ft';
            } else if (in_array($name, ['wall_assembly_code_front', 'wall_assembly_code_back', 'wall_assembly_code_right', 'wall_assembly_code_left'])) {
                $newValue = self::getWallAssembly($value);
            } else if ($name === 'roof_assembly_code') {
                $newValue = self::getRoofAssembly($value);
            } else if ($name === 'ceiling_assembly_code') {
                $newValue = self::ATTIC_INSULATION[$value];
            } else if ($name === 'floor_assembly_code') {
                $newValue = self::INSULATION_FLOOR[$value];
            } else if (strpos($name, 'roof_type_') === 0){
                $newValue = self::ATTIC_TYPE[$value];
            } else if (in_array($name, ['window_code_front', 'window_code_back', 'window_code_right', 'window_code_left', 'skylight_code'])) {
                $newValue = self::getWindowAssembly($value);
            } else if (in_array($name, $intToBoolFields)) {
                $value = BooleanHelper::getBoolValForThreeValueInt($value);
            }
            $newName = $newName ?? self::snakeToCapitalizedWords($name);
            
            if(!isset($newValue)) {
                if ($value === true || $value === 'user') {
                    $newValue = 'Yes';
                } else if($value === false || $value === 'shipment_weighted') {
                    $newValue = 'No';
                } else if($value === null) {
                    $newValue = 'N/A';
                } else {
                    $newValue = self::snakeToCapitalizedWords($value);
                }
            }
            
            $return[$newName] = $newValue ?? $value;
        }
      return $return;
    }
    
    /**
     * @param $snake a snake_case_string
     * @return string a Capitalized String
     */
    protected function snakeToCapitalizedWords($snake) : string
    {
        $return = [];
        $words = explode('_', $snake);
        foreach($words as $word) {
            $return[] = ucfirst($word);
        }
        $return = implode(' ', $return);
        return $return;
    }
}
