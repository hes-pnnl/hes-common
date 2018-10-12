<?php

namespace HESCommon\Services;


use HESCommon\Exceptions\UserSafeException;

class ValidationService extends Service
{
    const BLOCKER = 'blocker';
    const ERROR  = 'error';
    const MANDATORY = 'mandatory';

    /**
     * Calls validate_home_audit from the terminal via home_audit.cli.js
     *
     * @throws UserSafeException
     * @param array $homeValuesArray
     * @return array
     */
    public function getValidations(array $homeValuesArray) : array
    {
        $this->assertNodeIsInstalled();
        $homeValues = json_encode($homeValuesArray);
        $homeValues = escapeshellarg($homeValues);
        exec('node ../node_modules/hes-validation-engine/home_audit.cli.js '.$homeValues.' 2>&1', $output);
        /*
         * home_audit.cli will always return only one value.
         * If error is detected, home_audit.node will log a console error, which will be the first entries in our array
         * ie, $homeValues = '\'{"banana" : "apple"}\''
         */
        if(count($output) > 1){
            throw new UserSafeException($output[0]);
        }
        return json_decode(stripslashes($output[0]), true);
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
     * Gets validation message for a specific element
     *
     * @param array $validations Array of validation messages
     * @param string $name Name of the desired values/message
     * @return string|null
     */
    public function getValidationMessage(array $validations, string $name) : ?string
    {
        foreach($validations as $type) {
            if(array_key_exists($name, $type)) {
                return $type[$name];
            }
        }
        return null;
    }

    /**
     * Checks if validation messages are contained in validations array
     *
     * @param array $validations Array of validation messages
     * @return bool
     */
    public function validationMessagesExist(array $validations) : bool
    {
        foreach($validations as $type) {
            if(!empty($type)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Ensure node is installed before attempting to call command
     *
     * @throws UserSafeException
     */
    protected function assertNodeIsInstalled()
    {
        exec('which node 2>&1', $output);
        if(empty($output)){
            throw new UserSafeException('Node is not installed.');
        }
    }
}