<?php

/**
 * class DateRange - A simple little container for a range of dates
 */
namespace HESCommon;

class DateRange {
    // The string that separates the minimum date from the maximum date when rendering as a string
    const SEPARATOR = ' to ';
    const DATE_FORMAT = 'Y-m-d';

    /** @var \DateTime */
    private $minDate;

    /** @var \DateTime */
    private $maxDate;

    public function __construct(\DateTime $minDate, \DateTime $maxDate)
    {
        if ($minDate > $maxDate) {
            $tmp = $minDate;
            $minDate = $maxDate;
            $maxDate = $tmp;
        }

        $this->minDate = $minDate;
        $this->maxDate = $maxDate;
    }

    /**
     * @return \DateTime
     */
    public function getMinDate()
    {
        return $this->minDate;
    }

    /**
     * @return \DateTime
     */
    public function getMaxDate()
    {
        return $this->maxDate;
    }

    public static function fromString($string)
    {
        list($minDateString, $maxDateString) = explode(self::SEPARATOR, $string);
        $minDate = \DateTime::createFromFormat(self::DATE_FORMAT, $minDateString);
        $maxDate = \DateTime::createFromFormat(self::DATE_FORMAT, $maxDateString);

        return new static($minDate, $maxDate);
    }

    public function toString($separator = self::SEPARATOR)
    {
        return $this->minDate->format(self::DATE_FORMAT) . $separator . $this->maxDate->format(self::DATE_FORMAT);
    }
}