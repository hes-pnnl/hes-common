<?php
namespace HESCommon\Repositories;

/**
 * Class CronRuns
 *
 * Repository for interacting with records of runs by our cron jobs
 */
class CronRuns extends Repository
{
    /**
     *  Constants to define the legal values of the cron runs
     */
    const CRON_BUILDING_EXPORT    = 'building_export';
    const CRON_DEACTIVATED_EMAIL  = 'send_deactivated_email';

    /**
     * Gets the last run time for the specified cron
     * @param string $name The name of the cron to pull
     * @return string
     */
    public function getLastRunTime(string $name) : string
    {
        $result = $this->getApiDb()->selectOneSingleField("
            SELECT run_time
              FROM cron_runs
             WHERE name = ?
          ORDER BY run_time DESC
             LIMIT 1
        ", [$name]);

        $date = $result ?? '0001-01-01 01:00:00';
        return $date;
    }

    /**
     * Set new run time for the specified cron
     * @param string $name The name of the cron to pull
     * @param string|null $time (optional)
     */
    public function addRunTime(string $name, string $time = null)
    {
        $time = $time ?? $this->getCurrentDatabaseTime();
        $this->getApiDb()->insert("
           INSERT INTO cron_runs (name, run_time)
                VALUES (?, ?)
        ", [$name, $time]);
    }
}
