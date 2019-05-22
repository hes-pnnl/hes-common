<?php

namespace HESCommon\Services;

use HESCommon\Models\Building;

class BuildingService
{
    /** @var HesSoapApiService */
    protected $soapApiService;

    /** @var Building[] Cache of retrieved buildings. to prevent redundant SOAP calls */
    protected $buildings = [];

    public function __construct(HesSoapApiService $soapApiService) {
        $this->soapApiService = $soapApiService;
    }

    /**
     * Retrieves a Building instance. Buildings are locally cached, so there is no performance issue with making
     * multiple calls to this method for the same Building during the same request.
     *
     * @throws \Exception
     * @param int $buildingId
     * @return Building|null
     */
    public function getBuilding(int $buildingId) : ?Building
    {
        if (!array_key_exists($buildingId, $this->buildings)) {
            $this->buildings[$buildingId] = $this->getBuildingFromSoapApi($buildingId);
        }

        return $this->buildings[$buildingId];
    }

    /**
     * @param int $buildingId
     * @return Building|null
     */
    private function getBuildingFromSoapApi(int $buildingId) : ?Building
    {
        try {
            $response = $this->soapApiService->generateSoapCall(
                'retrieve_inputs',
                [
                    'building_id' => $buildingId
                ]
            );
        } catch (\SoapFault $soapFault) {
            if ($soapFault->getMessage() === "No building found for building_id #$buildingId") {
                return null;
            } else {
                throw $soapFault;
            }
        }

        // Do a bit of processing on the response to make it easier to work with:
        //   - Change the zone_wall collection to be indexed by side instead of by number
        foreach ($response['zone']['zone_wall'] as $key => $wall) {
            $side = $wall['side'];
            $response['zone']['zone_wall'][$side] = $wall;
            unset($response['zone']['zone_wall'][$key]);
        }

        $building = new Building($buildingId);

        /**
         * Sets a property in $building from a value in $response
         *
         * @param string $sourceLocation Dot-separated path to the value in $response e.g. zone.zone_roof.1.roof_area
         * @param mixed $obj The object on which to set the resultant value ($building by default)
         * @param string $setter The name of the setter function to pass the value to in $building. Is based on the
         *                       final string in $sourceLocation by default, e.g. setRoofArea()
         * @param callable $processor If passed, and the value is not NULL, then $processor will be passed the value and
         *                            the the value returned by $processor will be returned from $set
         */
        $set = function (string $sourceLocation, $obj = null, string $setter = null, callable $processor = null) use ($building, $response) {
            $sourceParts = explode('.', $sourceLocation);

            $value = $response;
            foreach ($sourceParts as $sourcePart) {
                if (!array_key_exists($sourcePart, $value)) {
                    throw new \Exception("Missing expected array key $sourcePart");
                }

                $value = $value[$sourcePart];
            }

            // If no setter is passed, then assume that, for example, the setter for assessment_type is setAssessmentType
            if (null === $setter) {
                $setter = 'set' . str_replace('_', '', ucwords($sourcePart, '_'));
            }

            if (null !== $value && null !== $processor) {
                $value = $processor($value);
            }

            if (null === $obj) {
                $obj = $building;
            }

            $obj->$setter($value);
        };

        $set('about.assessment_type');
        $set('about.assessment_date', null, null, function ($assessmentDate) {
            return date_create_from_format('Y-m-d', $assessmentDate);
        });
        $set('about.comments');
        $set('about.shape');
        $set('about.shape');

        $address = $building->getAddress();
        $set('about.address',$address, 'setStreet');
        $set('about.city', $address);
        $set('about.state', $address);
        $set('about.zip_code', $address, 'setZip');

        $set('about.town_house_walls', null,'setTownhousePosition');
        $set('about.year_built');
        $set('about.number_bedrooms');
        $set('about.num_floor_above_grade', null, 'setFloorsAboveGrade');
        $set('about.floor_to_ceiling_height');
        $set('about.conditioned_floor_area');
        $set('about.orientation');
        $set('about.blower_door_test', null, 'setWasBlowerTestPerformed');
        $set('about.air_sealing_present', null, 'setIsAirSealingPresent');
        $set('about.envelope_leakage');
        $set('about.external_building_id');

        $set('zone.wall_construction_same', null, 'setIsWallConstructionSameOnAllSides');
        $set('zone.window_construction_same', null, 'setIsWindowConstructionSameOnAllSides');

        foreach([1,2] as $roofNumber) {
            $roof = $building->getRoof($roofNumber);
            $responseRoofNumber = $roofNumber - 1; // Response uses 0-indexing
            $set("zone.zone_roof.$responseRoofNumber.roof_area", $roof, 'setArea');
            $set("zone.zone_roof.$responseRoofNumber.roof_assembly_code", $roof, 'setRoofAssemblyCode');
            $set("zone.zone_roof.$responseRoofNumber.roof_color", $roof, 'setColor');
            $set("zone.zone_roof.$responseRoofNumber.roof_absorptance", $roof, 'setAbsorptance');
            $set("zone.zone_roof.$responseRoofNumber.roof_type", $roof, 'setType');
            $set("zone.zone_roof.$responseRoofNumber.ceiling_assembly_code", $roof, 'setCeilingAssemblyCode');
/* TODO: Readd with solar_screen modeling
            $set("zone.zone_roof.$responseRoofNumber.zone_skylight.solar_screen", $roof, 'hasSolarScreen');
*/
            $set("zone.zone_roof.$responseRoofNumber.zone_skylight.skylight_area", $roof, 'setSkylightArea');
            $set("zone.zone_roof.$responseRoofNumber.zone_skylight.skylight_method", $roof, 'setSkylightMethod');
            $set("zone.zone_roof.$responseRoofNumber.zone_skylight.skylight_code", $roof, 'setSkylightAssemblyCode');
            $set("zone.zone_roof.$responseRoofNumber.zone_skylight.skylight_u_value", $roof, 'setSkylightUValue');
            $set("zone.zone_roof.$responseRoofNumber.zone_skylight.skylight_shgc", $roof, 'setSkylightShgc');
        }
        foreach([1,2] as $floorNumber) {
            $floor = $building->getFloor($floorNumber);
            $responseFloorNumber = $floorNumber - 1; // Response uses 0-indexing
            $set("zone.zone_floor.$responseFloorNumber.floor_area", $floor, 'setArea');
            $set("zone.zone_floor.$responseFloorNumber.floor_assembly_code", $floor, 'setAssemblyCode');
            $set("zone.zone_floor.$responseFloorNumber.foundation_insulation_level", $floor, 'setInsulationLevel');
            $set("zone.zone_floor.$responseFloorNumber.foundation_type", $floor, 'setType');
        }

        foreach ($building->getWalls() as $side => $wall) {
            $set("zone.zone_wall.$side.wall_assembly_code", $wall, 'setAssemblyCode');
        }
        foreach ($building->getWindows() as $side => $window) {
/* TODO: Readd with solar_screen modeling
            $set("zone.zone_wall.$side.zone_window.solar_screen", $window, 'hasSolarScreen');
*/
            $set("zone.zone_wall.$side.zone_window.window_area", $window, 'setArea');
            $set("zone.zone_wall.$side.zone_window.window_method", $window, 'setMethod');
            $set("zone.zone_wall.$side.zone_window.window_code", $window, 'setCode');
            $set("zone.zone_wall.$side.zone_window.window_u_value", $window, 'setUValue');
            $set("zone.zone_wall.$side.zone_window.window_shgc", $window, 'setShgc');
        }
        foreach ([1, 2] as $hvacNumber) {
            $hvac = $building->getHvac($hvacNumber);
            $responseHvacNumber = $hvacNumber - 1; // Response uses 0-indexing
            $set("systems.hvac.$responseHvacNumber.hvac_fraction", $hvac, 'setFraction');
            $set("systems.hvac.$responseHvacNumber.heating.type", $hvac, 'setHeatingType');
            $set("systems.hvac.$responseHvacNumber.heating.fuel_primary", $hvac, 'setHeatingFuel');
            $set("systems.hvac.$responseHvacNumber.heating.efficiency_method", $hvac, 'setHeatingEfficiencyMethod');
            $set("systems.hvac.$responseHvacNumber.heating.efficiency", $hvac, 'setHeatingEfficiency');
            $set("systems.hvac.$responseHvacNumber.heating.year", $hvac, 'setHeatingYearInstalled');
            $set("systems.hvac.$responseHvacNumber.cooling.type", $hvac, 'setCoolingType');
            $set("systems.hvac.$responseHvacNumber.cooling.efficiency_method", $hvac, 'setCoolingEfficiencyMethod');
            $set("systems.hvac.$responseHvacNumber.cooling.efficiency", $hvac, 'setCoolingEfficiency');
            $set("systems.hvac.$responseHvacNumber.cooling.year", $hvac, 'setCoolingYearInstalled');

            foreach (range(1, 3) as $ductNumber) {
                $duct = $hvac->getDuct($ductNumber);
                $responseDuctNumber = $ductNumber - 1; // Response uses 0-indexing
                $set("systems.hvac.$responseHvacNumber.hvac_distribution.$responseDuctNumber.location", $duct);
                $set("systems.hvac.$responseHvacNumber.hvac_distribution.$responseDuctNumber.fraction", $duct);
                $set("systems.hvac.$responseHvacNumber.hvac_distribution.$responseDuctNumber.insulated", $duct);
                $set("systems.hvac.$responseHvacNumber.hvac_distribution.$responseDuctNumber.sealed", $duct);
            }
        }

        $hotWater = $building->getHotWater();
        $set('systems.domestic_hot_water.type', $hotWater);
        $set('systems.domestic_hot_water.fuel_primary', $hotWater, 'setFuel');
        $set('systems.domestic_hot_water.efficiency_method', $hotWater);
        $set('systems.domestic_hot_water.year', $hotWater, 'setYearInstalled');
        $set('systems.domestic_hot_water.energy_factor', $hotWater);

        $photovoltaic = $building->getPhotovoltaic();
        $set('systems.generation.solar_electric.capacity_known', $photovoltaic);
        $set('systems.generation.solar_electric.system_capacity', $photovoltaic);
        $set('systems.generation.solar_electric.num_panels', $photovoltaic);
        $set('systems.generation.solar_electric.year', $photovoltaic);
        $set('systems.generation.solar_electric.array_azimuth', $photovoltaic);

        $HPwESResponse = $this->soapApiService->generateSoapCall(
            'retrieve_hpwes',
            [
                'building_id' => $buildingId
            ]
        );
        $HPwES = $building->getHPwES();
        $HPwES->setInstallationStartDate(date_create_from_format('Y-m-d', $HPwESResponse['improvement_installation_start_date']) ?: null);
        $HPwES->setInstallationCompletionDate(date_create_from_format('Y-m-d', $HPwESResponse['improvement_installation_completion_date']) ?: null);
        $HPwES->setContractorBusinessName($HPwESResponse['contractor_business_name']);
        $HPwES->setContractorZipCode($HPwESResponse['contractor_zip_code']);
        $HPwES->setIsIncomeEligible($HPwESResponse['is_income_eligible_program']);
        return $building;
    }
    
    /**
     * @throws \Exception
     * @param int $buildingId
     * @return string
     */
    public function getBuildingOwner($buildingId) : string
    {
        try {
            $response = $this->soapApiService->generateSoapCall(
                'building_ca_id',
                [
                    'building_id' => $buildingId
                ]
            );
        } catch (\SoapFault $soapFault) {
            if ($soapFault->getMessage() === "No building found for building_id #$buildingId") {
                return null;
            } else {
                throw $soapFault;
            }
        }
        return $response['qualified_assessor_id'];
    }
}
