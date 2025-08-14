<?php

namespace HESCommon\Repositories;

use HESCommon\DatabaseConnection;
use Illuminate\Database\DatabaseManager;

/**
 * class Repository
 *
 * Base class for repositories. Ideally one repository generally provides for
 * interaction with a single DB table. In practice this project's data is spread
 * across multiple tables in multiple databases and so repositories should at
 * least strive to represent access to a single *category* of data, such as
 * users, buildings, partners, etc.
 */
abstract class Repository
{
    /** @var DatabaseManager */
    protected $databaseMgr;

    /** @var DatabaseConnection */
    static protected $hesAdminDbConnection;

    /** @var DatabaseConnection */
    static protected $hesApiDbConnection;

    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseMgr = $databaseManager;
    }

    /**
     * Get a connection to the HES Admin database.
     *
     * @return DatabaseConnection
     */
    protected function getHesAdminDb() : DatabaseConnection
    {
        if (!self::$hesAdminDbConnection) {
            self::$hesAdminDbConnection = new DatabaseConnection($this->databaseMgr->connection('hes_admin'));
        }
        return self::$hesAdminDbConnection;
    }

    /**
     * Get a connection to the HES API database.
     *
     * @return DatabaseConnection
     */
    protected function getApiDb() : DatabaseConnection
    {
        if (!self::$hesApiDbConnection) {
            self::$hesApiDbConnection = new DatabaseConnection($this->databaseMgr->connection('hes_api'));
        }
        return self::$hesApiDbConnection;
    }

    /**
     * Removes any invalid characters in database identifiers and wraps them in backticks
     *
     * @param array $identifiers
     * @return array
     */
    protected function sanitizeIdentifiers(array $identifiers) : array
    {
        return array_map(function ($identifier) {
            return '\'' . preg_replace('/[^A-Za-z0-9_]+/', '', $identifier) . '\'';
        }, $identifiers);
    }

    /**
     * Generates a string like ?,?,?,?, suitable for injection as placeholders in an SQL string
     * @param int $numberOfQuestionMarks
     * @return string
     */
    protected function getQuestionMarks(int $numberOfQuestionMarks) : string
    {
        return implode(',', array_fill(0, $numberOfQuestionMarks, '?'));
    }

    /**
     * This will convert the query results to hash array
     * @param array $results
     * @return array
     */
    protected function objectArrayToArray(array $results) : array
    {
        // Map the query results to array and return
        return array_map(
            function($result) {
                return (array) $result;
            },
            $results
        );
    }

    /**
     * Gets current time in the database (to protect from web/SQL server time inconsistencies)
     * @param DatabaseConnection $database (optional) The database to check (default = hes_api)
     * @return string
     */
    protected function getCurrentDatabaseTime(DatabaseConnection $database = null) : string
    {
        $database = $database ?? $this->getApiDb();
        return $database->selectOneSingleField("SELECT NOW() as currentTime");
    }
}
