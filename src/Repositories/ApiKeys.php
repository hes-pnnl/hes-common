<?php


namespace HESCommon\Repositories;


use HESCommon\Models\ApiKey;

class ApiKeys extends Repository
{
    /**
     * Retrieves the ApiKey record with the passed API key
     * @param string $key
     * @return ApiKey|NULL
     * @throws \Exception
     */
    public function findByKey(string $key): ?ApiKey
    {
        return $this->getApiKey(["api_key" => $key]);
    }

    /**
     * Retrieves the ApiKey with the passed database ID
     * @param int $id
     * @return ApiKey|NULL
     * @throws \Exception
     */
    public function findById(int $id): ?ApiKey
    {
        return $this->getApiKey(["id" => $id]);
    }

    /**
     * Equivalent to getApiKeys() but returns only a single result. Intended for
     * use with filters that should only match a single result, but will return
     * the first matching result if you pass filters that return multiple results.
     * @param array $filters
     * @return ApiKey|NULL
     */
    public function getApiKey(array $filters) : ?ApiKey
    {
        $result = $this->getApiKeys($filters);
        if (count($result) > 0) {
            return $result[0];
        } else {
            return null;
        }
    }

    /**
     * Return a list of all API Keys and their data from the api_keys table
     * @retuen ApiKey[]
     * @param array|null $filters key value pair, e.g. ["id" => $id]
     * @return ApiKey[]
     */
    public function getApiKeys(?array $filters): array
    {
        $filter = '';
        $bindings = [];
        if ($filters) {
            if (array_key_exists("status", $filters) && $filters["status"]) {

                $filter .= " AND `ak`.`status_id` = ?";
                array_push($bindings, $filters["status"]);

            }
            if (array_key_exists("software_provider_id", $filters) && $filters["software_provider_id"]) {
                $filter .= " AND `software_providers_api_keys`.`software_provider_id` = ?";
                array_push($bindings, $filters["software_provider_id"]);
            }

            if (array_key_exists("id", $filters) && $filters["id"]) {
                $filter = $filter . " AND `ak`.`id` = ?";
                array_push($bindings, $filters["id"]);
            }

            if (array_key_exists("api_key", $filters) && $filters["api_key"]) {
                $filter = $filter . " AND `ak`.`api_key` = ?";
                array_push($bindings, $filters["api_key"]);
            }
        }

        $results = $this->getHesAdminDb()->select("
            SELECT `ak`.`id`,
                   `ak`.`api_key`,
                   `ak`.`status_id`,
                   `software_providers_api_keys`.`software_provider_id`,
                   `software_providers_api_keys`.`application`
              FROM `api_keys` AS `ak`
         LEFT JOIN `software_providers_api_keys` ON `software_providers_api_keys`.`api_key_id` = `ak`.`id`
             WHERE 1
        " . $filter, $bindings);
        $results = $this->objectArrayToArray($results);
        $apiKeys = [];
        foreach ($results as $result) {
            $entity = new ApiKey();
            $entity->setId($result["id"])
                ->setApiKey($result["api_key"])
                ->setStatusId($result["status_id"])
                ->setSoftwareProviderId($result["software_provider_id"])
                ->setApplication($result["application"]);
            array_push($apiKeys, $entity);
        }
        return $apiKeys;
    }
}