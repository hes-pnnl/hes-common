<?php
namespace HESCommon\Repositories;

/**
 * Class AccountStatuses
 *
 * Repository for interacting with Account Statuses and related data in the
 * database.
 */
class AccountStatuses extends Repository
{
    /**
     *  Constants to define the legal values of the account status
     */
    const STATUS_ACTIVE    = 'active';
    const STATUS_INACTIVE  = 'inactive';
    const STATUS_CANDIDATE = 'candidate';

    /**
     * Get the name of an account status given its database ID
     * @param int $id
     * @return string One of this class's STATUS_* constants
     */
    public function getNameById(int $id) : string
    {
        return $this->getHesAdminDb()->selectOneSingleField("
            SELECT name FROM account_statuses WHERE id = :id
        ", [
            'id' => $id
        ]);
    }

    /**
     * Get the database ID of an account status given its name
     * @param string $name One of this class's STATUS_* constants
     * @return string
     */
    public function getIdByName(string $name) : string
    {
        return $this->getHesAdminDb()->selectOneSingleField("
            SELECT id FROM account_statuses WHERE name = :name
        ", [
            'name' => $name
        ]);
    }

    /**
     * Retrieve a list of account statuses
     *
     * @return array Hash array mapping the status id to the status name
     */
    public function getStatuses() : array
    {
        $results = $this->getHesAdminDb()->select("
            SELECT id,
                   name
              FROM account_statuses
        ");
        $tableArray = $this->objectArrayToArray($results);
        $return = [];
        foreach($tableArray as $status) {
            $return[$status['id']] = $status['name'];
        }
        return $return;
    }

    /**
     * Check if a given status id exists in the database
     *
     * @param int $statusId
     * @return bool
     */
    public function statusIdExists(int $statusId) : bool
    {
        return $this->getHesAdminDb()->doesResultExist(
            "SELECT 1 FROM account_statuses WHERE id = :statusId",
            [
                "statusId" => $statusId
            ]
        );
    }
}
