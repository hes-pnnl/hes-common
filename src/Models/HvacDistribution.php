<?php

namespace HESCommon\Models;

use HESCommon\Helpers\BooleanHelper;

/**
 * Class HvacDistribution - Stores values associated with the set of ductwork for an HVAC system
 */
class HvacDistribution extends Model
{
    const LEAKAGE_METHOD_QUALITATIVE = 'qualitative';
    const LEAKAGE_METHOD_QUANTITATIVE = 'quantitative';

    /** @var string|null */
    protected $leakageMethod;

    /** @var float|null */
    protected $leakage;

    /** @var bool|null */
    protected $sealed;

    /** @var Duct[] */
    protected $ducts;

    public function __construct()
    {
        $this->ducts = [1 => new Duct(), 2 => new Duct(), 3 => new Duct()];
    }

    /**
     * @param int $system
     * @param int $count
     * @return array
     */
    public function getValuesAsArray(int $system)
    {
        return [
            'hvac_distribution_leakage_method_'.$system => $this->getLeakageMethod(),
            'hvac_distribution_leakage_to_outside_'.$system => $this->getLeakage(),
            'hvac_distribution_sealed_'.$system => BooleanHelper::getIntValForThreeValueBoolean($this->isSealed()),
        ];
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        // Check if local distribution values are empty
        $emptyDistValues = !($this->getLeakageMethod() || $this->getLeakage() || $this->isSealed() !== null);
        // If no base distribution values, check if ducts are empty as well
        if($emptyDistValues) {
            $emptyDucts = true;
            foreach($this->getDucts() as $duct) {
                $emptyDucts = $duct->isEmpty();
                // If we find a non-empty duct, we are done; this distribution is not empty
                if(!$emptyDucts) {
                    break;
                }
            }
            return $emptyDucts;
        } else {
            return $emptyDistValues;
        }
    }

    /**
     * @return string|null
     */
    public function getLeakageMethod(): ?string
    {
        return $this->leakageMethod;
    }

    /**
     * @param string|null $leakageMethod
     * @return HvacDistribution
     */
    public function setLeakageMethod(?string $leakageMethod): HvacDistribution
    {
        $this->leakageMethod = $leakageMethod;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLeakage(): ?float
    {
        return $this->leakage;
    }

    /**
     * @param float|null $leakage
     * @return HvacDistribution
     */
    public function setLeakage(?float $leakage): HvacDistribution
    {
        $this->leakage = $leakage;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function isSealed(): ?bool
    {
        return $this->sealed;
    }

    /**
     * @param bool|null $sealed
     * @return HvacDistribution
     */
    public function setSealed(?bool $sealed): HvacDistribution
    {
        $this->sealed = $sealed;
        return $this;
    }

    /**
     * @param int $ductNumber
     * @return Duct
     */
    public function getDuct(int $ductNumber) : Duct
    {
        if (!isset($this->ducts[$ductNumber])) {
            throw new \InvalidArgumentException("$ductNumber is not a valid duct number");
        }

        return $this->ducts[$ductNumber];
    }

    /**
     * @return Duct[] in the form [ <duct number> => Duct, ...] where duct number is 1-based
     */
    public function getDucts() : array
    {
        return $this->ducts;
    }
}
