<?php

namespace HESCommon\Models;

use HESCommon\DateRange;

/**
 * Class HPwES
 * Data container for Home performance with Energy Star values
 */
class HPwES extends Model
{
    /** @var DateRange|null */
    protected $installationDates;

    /** @var \DateTime|null */
    protected $installationStartDate;

    /** @var \DateTime|null */
    protected $installationEndDate;

    /** @var string|null */
    protected $contractorBusinessName;

    /** @var string|null */
    protected $contractorZipCode;

    /** @var bool|null */
    protected $isIncomeEligible;

    /**
     * @return array
     */
    public function getValuesAsArray()
    {
        return [
            'improvement_installation_start_date' => $this->getInstallationStartDate(),
            'improvement_installation_completion_date' => $this->getInstallationCompletionDate(),
            'contractor_business_name' => $this->getContractorBusinessName(),
            'contractor_zip_code' => $this->getContractorZipCode(),
            'is_income_eligible_program' => $this->getIsIncomeEligible(),
        ];
    }

    /**
     * Takes an array in the form returned by a call to the retrieve_hpwes SOAP API method and converts it to
     * an instance of HPwES
     *
     * @param array $response
     * @return static
     */
    public static function fromRetrieveHPwESSoapResponse(array $response)
    {
        $startDate = $response['improvement_installation_start_date'];
        $completionDate = $response['improvement_installation_completion_date'];
        if ($startDate && $completionDate) {
            $dateRange = new DateRange(
                date_create_from_format('Y-m-d', $startDate),
                date_create_from_format('Y-m-d', $completionDate)
            );
        } else {
            $dateRange = null;
        }

        $HPwES = new static(
            $dateRange,
            $response['contractor_business_name'],
            $response['contractor_zip_code'],
            $response['is_income_eligible_program'] === "true"
        );

        return $HPwES;
    }

    /**
     * @return bool TRUE if at least one member property is not NULL
     */
    public function hasAtLeastOneSetValue()
    {
        return $this->getInstallationDates()
            || $this->getContractorBusinessName()
            || $this->getContractorZipCode()
            || $this->isIncomeEligible();
    }

    /**
     * @return DateRange?null
     */
    public function getInstallationDates() : ?DateRange
    {
        return $this->installationDates;
    }

    /**
     * @return \DateTime|null
     */
    public function getInstallationStartDate() : ?\DateTime
    {
        return $this->installationStartDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getInstallationCompletionDate() : ?\DateTime
    {
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
     * @return bool|null
     */
    public function isIncomeEligible() : ?bool
    {
        return $this->isIncomeEligible;
    }

    //TODO: If the way I've reimplemented DateRange works, I don't think this function is needed anymore...
    /**
     * @param DateRange|null $installationDates
     * @return HPwES
     */
    public function setInstallationDates(?DateRange $installationDates): HPwES
    {
        $this->installationDates = $installationDates;
        return $this;
    }

    /**
     * @param \DateTime|null $installationDates
     * @return HPwES
     */
    public function setInstallationStartDate(?\DateTime $installationStartDate): HPwES
    {
        $this->installationStartDate = $installationStartDate;
        return $this;
    }

    /**
     * @param \DateTime|null $installationDates
     * @return HPwES
     */
    public function setInstallationCompletionDate(?\DateTime $installationEndDate): HPwES
    {
        $this->installationEndDate = $installationEndDate;
        return $this;
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

    /**
     * @param bool|null $isIncomeEligible
     * @return HPwES
     */
    public function setIsIncomeEligible(?bool $isIncomeEligible): HPwES
    {
        $this->isIncomeEligible = $isIncomeEligible;
        return $this;
    }

    /**
     * Renders a date range picker for the improvement installation start and completion dates
     * @return string
     */
    public function renderDateInput()
    {
        $dateRange = $this->getInstallationDates();
        $dateRange = $dateRange ? $dateRange->toString() : '';

        return <<<HTML
            <input id="HPwES-date-range"
                   name="HPwES-date-range"
                   class="date-range"
                   value="$dateRange">
            <script>
                $('#HPwES-date-range').dateRangePicker({});
            </script>
HTML;
    }

    /**
     * @return string
     */
    public function renderContractorBusinessName()
    {
        $contractorBusinessName = $this->getContractorBusinessName();
        return "
            <input id='HPwES-contractor-business-name'
                   name='HPwES-contractor-business-name'
                   value='$contractorBusinessName'>
        ";
    }

    /**
     * @return string
     */
    public function renderContractorZipCode()
    {
        $contractorZipCode = $this->getContractorZipCode();
        return "
            <input id='HPwES-contractor-zip-code'
                   name='HPwES-contractor-zip-code'
                   value='$contractorZipCode'>
        ";
    }

    /**
     * @return string
     */
    public function renderIsIncomeEligible()
    {
        $checked = $this->isIncomeEligible() ? 'checked' : '';
        return "
            <input type='checkbox'
                   id='HPwES-is-income-eligible'
                   name='HPwES-is-income-eligible'
                   value='1'
                   $checked>
        ";
    }
}
