<?php
namespace HESCommon\Models;
/**
 * Class User - Contains the user information.
 */
class User extends Model
{

    /** @var ?int */
    protected $id;

    /** @var string user name */
    protected $name;

    /** @var string */
    protected $fullName;

    /** @var string */
    protected $email;

    /** @var ?int */
    protected $hesPartnerId;

    /** @var ?int */
    protected $performQAId;

    /** @var ?int */
    protected $qualityAssuranceProviderId;

    /** @var int  */
    protected $isBlocked;

    /** @var string */
    protected $created;

    /** @var Company */
    protected $Company;

    /** @var array of string */
    protected $roles;

    //Getter methods
    /**
     * @return int
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
     * @return ?int
     */
    public function getHesPartnerId() : int
    {
        return $this->hesPartnerId;
    }

    /**
     * @return ?int
     */
    public function getPerformQAId() : ?int
    {
        return $this->performQAId;
    }
    /**
     * @return ?int
     */
    public function getQualityAssuranceProviderId() : int
    {
        return $this->qualityAssuranceProviderId;
    }


    /**
     * @return int
     */
    public function getIsBlocked() : int
    {
        return $this->isBlocked;
    }

    /**
     * @return string
     */
    public function getCreated() : string
    {
        return $this->created;
    }

    /**
     * @return Company
     */
    public function getCompany() : Company
    {
        return $this->company;
    }

    /**
     * @return array
     */
    public function getRoles() : array
    {
        return $this->roles;
    }

    //Setter methods
    /**
     * @return User
     * @param string $id
     */
    public function setId(string $id) : User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return User
     * @param string $name
     */
    public function setUser(string $name) : User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return User
     * @param string $fullName
     */
    public function setFullName(string $fullName) : User
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @return User
     * @param string $email
     */
    public function setEmail(string $email) : User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return User
     * @param ?int $hesPartnerId
     */
    public function setHesPartnerId(?int $hesPartnerId) : User
    {
        $this->hesPartnerId = $hesPartnerId;
        return $this;
    }

    /**
     * @return User
     * @param ?int $performQAId
     */
    public function setPerformQAId(?int $performQAId) : User
    {
        $this->performQAId = $performQAId;
        return $this;
    }

    /**
     * @return User
     * @param ?int $qualityAssuranceProviderId
     */
    public function setQualityAssuranceProviderId(?int $qualityAssuranceProviderId) : User
    {
        $this->qualityAssuranceProviderId = $qualityAssuranceProviderId;
        return $this;
    }

    /**
     * @return User
     * @param int $isBlocked
     */
    public function setIsBlocked(int $isBlocked) : User
    {
        $this->isBlocked = $isBlocked;
        return $this;
    }

    /**
     * @return User
     * @param string $created
     */
    public function setCreated(string $created) : User
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return User
     * @param Company $company
     */
    public function setCompany(string $company) : User
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return User
     * @param array $roles
     */
    public function setRoles(array $roles) : User
    {
        $this->roles = $roles;
        return $this;
    }
 }