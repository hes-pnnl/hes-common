<?php

namespace HESCommon\Models;

/**
 * Class HPwES
 * Data container for Home performance with Energy Star values
 */
class HPwES extends Model
{
    /** @var \DateTime|null */
    protected $installationStartDate;

    /** @var \DateTime|null */
    protected $installationEndDate;

    /** @var string|null */
    protected $contractorBusinessName;

    /** @var string|null */
    protected $contractorZipCode;

    /**
     * Takes an array in the form returned by a call to the retrieve_hpwes SOAP API method and converts it to
     * an instance of HPwES
     *
     * @param array $response
     * @return static
     */
    public static function fromRetrieveHPwESSoapResponse(array $response)
    {
        $startDate = date_create_from_format('Y-m-d', $response['improvement_installation_start_date']);
        $completionDate = date_create_from_format('Y-m-d', $response['improvement_installation_completion_date']);

        $HPwES = new static();
        $HPwES->setInstallationStartDate($startDate)
            ->setInstallationCompletionDate($completionDate)
            ->setContractorBusinessName($response['contractor_business_name'])
            ->setContractorZipCode($response['contractor_zip_code']);

        return $HPwES;
    }

    /**
     * @return bool TRUE if at least one member property is not NULL
     */
    public function hasAtLeastOneSetValue()
    {
        return $this->getInstallationStartDate()
            || $this->getInstallationCompletionDate()
            || $this->getContractorBusinessName()
            || $this->getContractorZipCode();
    }

    /**
     * @param string $format Pass to get the date as a string in the given format. e.g. "Y-m-d"
     * @return \DateTime|string|null
     */
    public function getInstallationStartDate(string $format = null)
    {
        if ($format && $this->installationStartDate !== null) {
            return $this->installationStartDate->format($format);
        }

        return $this->installationStartDate;
    }

    /**
     * @param string $format Pass to get the date as a string in the given format. e.g. "Y-m-d"
     * @return \DateTime|string|null
     */
    public function getInstallationCompletionDate(string $format = null)
    {
        if ($format && $this->installationEndDate !== null) {
            return $this->installationEndDate->format($format);
        }

        return $this->installationEndDate;
    }

    /**
     * @return string|null
     */
    public function getContractorBusinessName() : ?string
    {
        return $this->contractorBusinessName;
    }

    /**
     * @return string|null
     */
    public function getContractorZipCode() : ?string
    {
        return $this->contractorZipCode;
    }

    /**
     * @param \DateTime|string|null $installationStartDate
     * @param string $format Pass if $installationStartDate is a string, to indicate the format of the string
     * @return HPwES
     */
    public function setInstallationStartDate($installationStartDate, string $format = null): HPwES
    {
        $this->installationStartDate = $this->_getDate($installationStartDate, $format);
        return $this;
    }

    /**
     * @param \DateTime|string|null $installationEndDate
     * @param string $format Pass if $installationEndDate is a string, to indicate the format of the string
     * @return HPwES
     */
    public function setInstallationCompletionDate($installationEndDate, string $format = null): HPwES
    {
        $this->installationEndDate = $this->_getDate($installationEndDate, $format);
        return $this;
    }

    /**
     * Allows a date to be defined either as a \DateTime instance, or as a string with an accompanying format.
     *
     * @param \DateTime|string|null $date
     * @param string $format Pass if $installationEndDate is a string, to indicate the format of the string
     * @return \DateTime
     */
    private function _getDate($date, string $format = null) : \DateTime
    {
        if ($format) {
            if (!is_string($date)) {
                throw new \InvalidArgumentException("date must be a string if you pass a format");
            }
            $date = date_create_from_format($format, $date);
        }

        if (!$date instanceof \DateTime) {
            throw new \InvalidArgumentException("date must either be a DateTime or a string with an accompanying format.");
        }

        return $date;
    }

    /**
     * @param null|string $contractorBusinessName
     * @return HPwES
     */
    public function setContractorBusinessName(?string $contractorBusinessName): HPwES
    {
        $this->contractorBusinessName = $contractorBusinessName;
        return $this;
    }

    /**
     * @param null|string $contractorZipCode
     * @return HPwES
     */
    public function setContractorZipCode(?string $contractorZipCode): HPwES
    {
        $this->contractorZipCode = $contractorZipCode;
        return $this;
    }
}
