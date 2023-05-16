<?php

namespace HESCommon\Repositories;

/**
 * Class MaintenancePeriods
 * Responsible for activating and deactivating maintenance mode. A maintenance period is represented in the database
 * as a text message to be shown when users attempt access during the matinenance period, along with timestamps
 * indicating the beginning and ending times of the maintenance period.
 */
class MaintenancePeriods extends Repository
{
    /**
     * Begins a maintenance period. Until endMaintenancePeriod() is called, all API calls will fail
     * and return the indicated message.
     *
     * @param string $message The message to display to users while maintenance mode is active
     */
    public function startMaintenancePeriod(string $message) : void
    {
        $this->getHesAdminDb()->insert("
            INSERT INTO maintenance_periods (message) VALUES (:message)
        ", [
            'message' => $message
        ]);
    }

    /**
     * End the current maintenance period, if one is currently active. If there is no active maintenance period,
     * this function will have no effect.
     */
    public function endMaintenancePeriod() : void
    {
        $this->getHesAdminDb()->update('
            UPDATE maintenance_periods SET end_time = now() WHERE end_time IS NULL
        ');
    }

    /**
     * If a maintenance period is currently active, will return the associated message. If no maintenance period is
     * currently active, returns null.
     *
     * @return string|null
     */
    public function getMessage() : ?string
    {
        return $this->getHesAdminDb()->selectOneSingleField('
            SELECT message FROM maintenance_periods WHERE end_time IS NULL
        ');
    }

    /**
     * Returns TRUE if there is currently an active maintenance period, otherwise FALSE.
     *
     * @return bool
     */
    public function isMaintenancePeriodActive() : bool
    {
        return $this->getMessage() !== null;
    }
}
