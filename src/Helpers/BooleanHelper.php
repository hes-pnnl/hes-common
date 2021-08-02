<?php

namespace HESCommon\Helpers;

/**
 * Class EmailHelper
 */
class BooleanHelper extends Helper
{
    /**
     * Returns int value of a bool, or null or entered value is null
     * @param bool|null $val
     * @return int|null
     */
    public static function getIntValForThreeValueBoolean(?bool $val) : ?int
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
    public static function getBoolValForThreeValueInt(?int $val) : ?bool
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

    /**
     * Returns bool value of any type of input getting from the front-end
     * @param $input
     * @return bool|null
     */
    public static function getBoolValFromGUI($input): bool
    {
        return in_array( $input, ["true", 1, "1", true]);
    }
}
