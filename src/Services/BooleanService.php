<?php

namespace HESCommon\Services;

// TODO: This class should be a Helper instead of a Service
class BooleanService extends Service
{
    /**
     * Returns int value of a bool, or null or entered value is null
     * @param bool|null $val
     * @return int|null
     */
    public function getIntValForThreeValueBoolean(?bool $val) : ?int
    {
        if (null !== $val) {
            return (int) $val;
        }
        return null;
    }
    
    /**
     * Returns bool value of an int, or null or entered value is null
     * @param int|null $val
     * @return bool|null
     */
    public function getBoolValForThreeValueInt(?int $val) : ?bool
    {
        switch($val) {
            case 1:
                $return = true;
                break;
            case 0:
                $return = false;
                break;
            default:
                $return = null;
        }
        return $return;
    }
}
