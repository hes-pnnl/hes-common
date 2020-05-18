<?php

namespace HESCommon;


use Closure;
use Illuminate\Database\Connection;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\Log;

/**
 * Class DatabaseConnection
 * A wrapper class for Illuminate\Database\Connection that allows us to extend the basic Connection's functionality
 *
 * We implement this as a wrapper around the real connection instead of just extending the Connection class because
 * the Connection is pretty hard-wired into Laravel and actually getting the DatabaseManager to give you an instance
 * of your own extended class is fairly difficult.
 */
class DatabaseConnection implements ConnectionInterface
{
    /** @var Connection */
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Combines selectOne() and selectSingleField() - returns a single scalar value from an SQL statement
     *
     * @param string $sql
     * @param array $bindings
     * @param string|null $fieldName
     * @return string|null
     */
    public function selectOneSingleField(string $sql, array $bindings = [], string $fieldName = null) : ?string
    {
        $results = $this->selectSingleField($sql, $bindings, $fieldName);

        if (empty($results)) {
            return null;
        }

        $result = reset($results);

        return $result;
    }

    /**
     * Given a SELECT statement, returns an array containing the values of a single field returned by that statement.
     *
     * Example: selectSingleField('SELECT id FROM users WHERE name LIKE "%blah%"') => gives an array of id values
     *
     * @param string $sql
     * @param string $fieldName
     * @param array $bindings
     * @return array
     */
    public function selectSingleField(string $sql, array $bindings = [], string $fieldName = null) : array
    {
        $queryResults = $this->select($sql, $bindings);

        if (empty($queryResults)) {
            return [];
        }

        // If no field name is passed, the select statement must only return one field. Use the name of that field
        // as the field name.
        if (null === $fieldName) {
            $firstResult = reset($queryResults);
            $objectVars = get_object_vars($firstResult);
            if (count($objectVars) !== 1) {
                throw new \Exception('selectSingleField() must be passed a $fieldName property if multiple fields are returned by the passed query. The query returned the following fields: ' . implode(', ', $objectVars));
            }
            $objectProperties = array_keys($objectVars);
            $fieldName = reset($objectProperties);
        }

        $resultsToReturn = array_map(function($result) use ($fieldName) {
            return $result->$fieldName;
        }, $queryResults);

        return $resultsToReturn;
    }

    /**
     * Given a SELECT statement, returns TRUE if that statement returns at least one result
     *
     * Note: Given the nature of this method, for efficiency's sake you should always SELECT 1 or SELECT <some field> rather
     * than SELECT *, and include LIMIT 1 in your request if it could potentially return more than one result.
     *
     * @param string $selectSql
     * @param array $bindings
     * @return bool
     */
    public function doesResultExist(string $selectSql, array $bindings = []) : bool
    {
        $result = $this->select($selectSql, $bindings);
        $count = count($result);
        if ($count > 1) {
            Log::warning("Select statement passed to doesResultExist returned $count results. Since this method only checks whether any results were returned, you should always call it with SQL that returns either 0 or 1 result (e.g. use LIMIT 1)");
        }
        return $count > 0;
    }

    /**
     *Helper function to check if the table or field name is valid, only accepts name contains letters and underscore
     * @param string $name
     * @throws \Exception
     */
    private function validateTableOrField(string $name){
        if(!preg_match('/^[a-z\_]+$/', $name) ) {
            throw new \Exception("Table name or field name $name is not valid.");
        }
    }

    /**
     * Get the hash map of 2 fields of a table
     * @param string $table
     * @param string $keyField
     * @param string $valueField
     * @return array
     * @throws \Exception
     */
    public function getFieldMapping(string $table, string $keyField, string $valueField): array
    {
        $this->validateTableOrField($table);
        $this->validateTableOrField($keyField);
        $this->validateTableOrField($valueField);

        $results = $this->select("
            SELECT `$keyField`,
                   `$valueField`
              FROM `$table`
        ");
        $return = [];
        foreach ($results as $status) {
            $return[$status->$keyField] = $status->$valueField;
        }
        return $return;
    }

    /***
     * The methods in this section all simply map to the equivalent method of the underlying connection class.
     */
    public function table($table) { return $this->connection->table($table); }
    public function raw($value) { return $this->connection->raw($value); }
    public function selectOne($query, $bindings = [], $useReadPdo = true) { return $this->connection->selectOne($query, $bindings, $useReadPdo); }
    public function select($query, $bindings = [], $useReadPdo = true) { return $this->connection->select($query, $bindings, $useReadPdo); }
    public function cursor($query, $bindings = [], $useReadPdo = true) { return $this->connection->cursor($query, $bindings, $useReadPdo); }
    public function insert($query, $bindings = []) { return $this->connection->insert($query, $bindings); }
    public function update($query, $bindings = []) { return $this->connection->update($query, $bindings); }
    public function delete($query, $bindings = []) { return $this->connection->delete($query, $bindings); }
    public function statement($query, $bindings = []) { return $this->connection->statement($query, $bindings); }
    public function affectingStatement($query, $bindings = []) { return $this->connection->affectingStatement($query, $bindings); }
    public function unprepared($query) { return $this->connection->unprepared($query); }
    public function prepareBindings(array $bindings) { return $this->connection->prepareBindings($bindings); }
    public function transaction(Closure $callback, $attempts = 1) { return $this->connection->transaction($callback, $attempts); }
    public function beginTransaction() { $this->connection->beginTransaction(); }
    public function commit() { $this->connection->commit(); }
    public function rollBack() { $this->connection->rollBack(); }
    public function transactionLevel() { return $this->connection->transactionLevel(); }
    public function pretend(Closure $callback) { return $this->connection->pretend($callback); }
}
