<?php
namespace HESCommon\Models;

/**
 * Class SoftwareProvider
 * SoftwareProvider information.
 */
class SoftwareProvider extends Model
{

    /** @var int|null */
    private $id;
    
    /** @var string */
    private $name;

    /** @var int */
    private $statusId;

    /** @var int */
    private $managerId;

    /**
     * @return SoftwareProvider
     * @param int $id
     */
    public function setId(int $id) : SoftwareProvider
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return SoftwareProvider
     * @param string $name
     */
    public function setName(string $name) : SoftwareProvider
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return SoftwareProvider
     * @param int $statusId
     */
    public function setStatusId(int $statusId) : SoftwareProvider
    {
        $this->statusId = $statusId;
        return $this;
    }

    /**
     * @return SoftwareProvider
     * @param int $managerId
     */
    public function setManagerId(int $managerId) : SoftwareProvider
    {
        $this->managerId = $managerId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getId() : ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getStatusId(): int
    {
        return $this->statusId;
    }

    /**
     * @return int
     */
    public function getManagerId(): int
    {
        return $this->managerId;
    }
    
}