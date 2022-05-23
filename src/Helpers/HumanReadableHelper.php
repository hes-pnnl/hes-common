<?php

namespace HESCommon\Helpers;

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

    const TOWNHOUSE_POSITIONS = [
        "back_front"=>"Middle",
        "back_front_left"=>"Left",
        "back_right_front"=>"Right"
    ];
    
    /* Wall Codes */
    const CONSTRUCTION_WALL = [
        "ewwf"=>"Wood Frame",
        "ewps"=>"Wood Frame with rigid foam sheathing",
        "ewov"=>"Wood Frame with Optimum Value Engineering (OVE)",
        "ewbr"=>"Structural Brick",
        "ewcb"=>"Concrete Block or Stone",
        "ewsb"=>"Straw Bale"
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
        "07"=>"R-7",
        "11"=>"R-11",
        "13"=>"R-13",
        "15"=>"R-15",
        "19"=>"R-19",
        "21"=>"R-21",
        "27"=>"R-27",
        "33"=>"R-33",
        "38"=>"R-38",
        "05"=>"R-5",
        "10"=>"R-10",
        "06"=>"R-6",
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
        "11"=>"R-11",
        "13"=>"R-13",
        "15"=>"R-15",
        "19"=>"R-19",
        "21"=>"R-21",
        "27"=>"R-27",
        "30"=>"R-30",
    ];
    const ATTIC_TYPE = [
        "vented_attic" => "Unconditioned Attic",
        "cond_attic" => "Conditioned Attic",
        "cath_ceiling" => "Cathedral Ceiling"
    ];
    const ATTIC_INSULATION = [
        "ecwf00" => "R-0",
        "ecwf03" => "R-3",
        "ecwf06" => "R-6",
        "ecwf09" => "R-9",
        "ecwf11" => "R-11",
        "ecwf19" => "R-19",
        "ecwf21" => "R-21",
        "ecwf25" => "R-25",
        "ecwf30" => "R-30",
        "ecwf38" => "R-38",
        "ecwf44" => "R-44",
        "ecwf49" => "R-49",
        "ecwf60" => "R-60"
    ];
    const KNEE_WALL_ASSEMBLY = [
        "kwwf00" => "R-0",
        "kwwf03" => "R-3",
        "kwwf07" => "R-7",
        "kwwf11" => "R-11",
        "kwwf13" => "R-13",
        "kwwf15" => "R-15",
        "kwwf17" => "R-17",
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
        "vented_crawl"=>"Vented Crawlspace"
    ];
    const INSULATION_FLOOR = [
        ""=>"-Select-",
        "efwf00ca"=>"R-0",
        "efwf11ca"=>"R-11",
        "efwf13ca"=>"R-13",
        "efwf15ca"=>"R-15",
        "efwf19ca"=>"R-19",
        "efwf21ca"=>"R-21",
        "efwf25ca"=>"R-25",
        "efwf30ca"=>"R-30",
        "efwf38ca"=>"R-38"
    ];
    const FOUNDATION_INSULATION = [
        "0"=>"R-0",
        "5"=>"R-5",
        "11"=>"R-11",
        "19"=>"R-19",
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
        "cond_space"      => "Conditioned space",
        "uncond_basement" => "Unconditioned basement",
        "vented_crawl"    => "Vented crawlspace",
        "unvented_crawl"  => "Unvented crawlspace / Unconditioned garage",
        "uncond_attic"    => "Unconditioned attic",
        'under_slab'      => 'Under slab',
        'exterior_wall'   => 'In exterior wall',
        'outside'         => 'Outside'
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
        "lpg"           => "LPG",
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
            $assembly .= "/".self::FINISH[substr($assemblyCode, 6, 2)];
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
            } else if ($name === 'town_house_walls') {
                $newName = 'Townhouse Position';
                $newValue = self::TOWNHOUSE_POSITIONS[$value];
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
