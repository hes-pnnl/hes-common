<?php
namespace HESCommon\Models;
/**
 * Class Assessor - Contains the Assessor information.
 */
class Assessor extends Model
{

    /** @var int|null */
    protected $id;

    /** @var string user name */
    protected $name;

    /** @var string */
    protected $fullName;

    /** @var string */
    protected $email;

    /** @var int|null */
    protected $hesPartnerId;

    /** @var \Datetime|null */
    protected $roleCreated;

    /** @var \Datetime|null */
    protected $roleUpdated;

    /** @var \Datetime|null */
    protected $roleDeactivated;

    //Getter methods
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
     * @return string
     */
    public function getFullName() : string
    {
        return $this->fullName;
    }

    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @return int|null
     */
    public function getHesPartnerId() : ?int
    {
        return $this->hesPartnerId;
    }

    /**
     * @return \DateTime|null
     */
    public function getRoleCreated() : ?\DateTime
    {
        return $this->roleCreated;
    }

    /**
     * @return \DateTime|null
     */
    public function getRoleUpdated() : ?\DateTime
    {
        return $this->roleUpdated;
    }

    /**
     * @return \DateTime|null
     */
    public function getRoleDeactivated() : ?\DateTime
    {
        return $this->roleDeactivated;
    }

    //Setter methods
    /**
     * @return Assessor
     * @param int $id
     */
    public function setId(int $id) : Assessor
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Assessor
     * @param string $name
     */
    public function setName(string $name) : Assessor
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Assessor
     * @param string $fullName
     */
    public function setFullName(string $fullName) : Assessor
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @return Assessor
     * @param string $email
     */
    public function setEmail(string $email) : Assessor
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return Assessor
     * @param int|null $hesPartnerId
     */
    public function setHesPartnerId(?int $hesPartnerId) : Assessor
    {
        $this->hesPartnerId = $hesPartnerId;
        return $this;
    }

    /**
     * @param \DateTime|null $roleCreated
     * @return Assessor
     */
    public function setRoleCreated(?\DateTime $roleCreated) : Assessor
    {
        $this->roleCreated = $roleCreated;
        return $this;
    }

    /**
     * @param \DateTime|null $roleUpdated
     * @return Assessor
     */
    public function setRoleUpdated(?\DateTime $roleUpdated) : Assessor
    {
        $this->roleUpdated = $roleUpdated;
        return $this;
    }

    /**
     * @return Assessor
     * @param \DateTime|null $roleDeactived
     */
    public function setRoleDeactivated(?\DateTime $roleDeactived) : Assessor
    {
        $this->roleDeactivated = $roleDeactived;
        return $this;
    }
 }