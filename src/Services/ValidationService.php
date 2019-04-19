<?php

namespace HESCommon\Services;

use HESCommon\Models\Building;
use HESCommon\Exceptions\UserSafeException;
use HESCommon\Helpers\ExecHelper;

class ValidationService
{
    const BLOCKER = 'blocker';
    const ERROR  = 'error';
    const MANDATORY = 'mandatory';

    /**
     * The path to the directory under which NPM modules are installed (usually called node_modules/)
     * @var string
     */
    protected $nodeModulesPath;

    /**
     * Stores the last result returned from getValidations()
     *
     * @var array
     */
    protected $validations;

    public function __construct(string $nodeModulesPath)
    {
        $this->nodeModulesPath = $nodeModulesPath;
    }

    /**
     * Calls validate_home_audit from the terminal via home_audit.cli.js
     *
     * @throws UserSafeException
     * @param array $homeValuesArray
     * @return array
     */
    public function getValidations(array $homeValuesArray) : array
    {
        ExecHelper::assertNodeIsInstalled();
        $homeValues = json_encode($homeValuesArray);
        $homeValues = escapeshellarg($homeValues);
        exec("node $this->nodeModulesPath/hes-validation-engine/home_audit.cli.js $homeValues 2>&1", $output);
        /*
         * home_audit.cli will always return only one value.
         * If error is detected, home_audit.node will log a console error, which will be the first entries in our array
         * ie, $homeValues = '\'{"banana" : "apple"}\''
         */
        if(count($output) > 1){
            throw new UserSafeException("Validation failed: " . $output[0]);
        }
        $this->validations = json_decode($output[0], true);
        return $this->validations;
    }

    /**
     * @param Building $building
     * @return array
     * @throws UserSafeException
     */
    public function getValidationsForBuilding(Building $building) : array
    {
        return $this->getValidations($building->getValuesForValidation());
    }

    /**
     * Check validation messages for 'blocker' type
     *
     * @throws UserSafeException
     * @param array $homeValuesArray
     * @return bool
     */
    public function isBlockerPresent(array $homeValuesArray) : bool
    {
        $validations = $this->getValidations($homeValuesArray);
        if(array_key_exists(self::BLOCKER, $validations) && !empty($validations[self::BLOCKER])){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Gets validation message for a specific element.
     *
     * @param string $name Name of the desired values/message
     * @param array $validationMessages Optional. In a situation where you are dealing with multiple buildings or otherwise
     *     need to supply the validation messages instead of using the last result of getValidations(), you can pass the
     *     result returned by getValidation() as this argument.
     * @return string|null
     */
    public function getValidationMessage(string $name, $validationMessages = null) : ?string
    {
        if (null === $validationMessages && null === $this->validations) {
            throw new \Exception('This message cannot be called without a $validationMessages argument unless getValidations() has been called to populate the validations');
        }

        foreach($validationMessages ?? $this->validations as $type) {
            if(array_key_exists($name, $type)) {
                return $type[$name];
            }
        }
        return null;
    }

    /**
     * Checks if validation messages are contained in validations array
     *
     * @throws \Exception
     * @param array $validations Array of validation messages Optional, if not passed then the last result of
     *     getValidationMessages() is used
     * @return bool
     */
    public function validationMessagesExist(array $validations = null) : bool
    {
        if (null === $validations && null === $this->validations) {
            throw new \Exception('This message cannot be called without a $validationMessages argument unless getValidations() has been called to populate the validations');
        }

        foreach($validations ?? $this->validations as $type) {
            if(!empty($type)) {
                return true;
            }
        }
        return false;
    }
}
