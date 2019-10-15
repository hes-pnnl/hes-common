<?php
namespace HESCommon\Models;
/**
 * Class User - Contains the user information.
 */
class User extends Model
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

    /** @var int|null */
    protected $performQAId;

    /** @var int|null */
    protected $qualityAssuranceProviderId;

    /** @var bool */
    protected $isBlocked;

    /** @var \DateTime */
    protected $created;

    /** @var Company */
    protected $Company;

    /** @var int[] */
    protected $roles;

    /** @var int[] */
    protected $certifications;

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
     * @return int|null
     */
    public function getPerformQAId() : ?int
    {
        return $this->performQAId;
    }
    /**
     * @return int|null
     */
    public function getQualityAssuranceProviderId() : ?int
    {
        return $this->qualityAssuranceProviderId;
    }


    /**
     * @return bool
     */
    public function getIsBlocked() : bool
    {
        return $this->isBlocked;
    }

    /**
     * @return \DateTime
     */
    public function getCreated() : \DateTime
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
     * @return int[]
     */
    public function getRoles() : array
    {
        return $this->roles;
    }

    /**
     * @return int[]
     */
    public function getCertifications() : array
    {
        return $this->certifications;
    }

    //Setter methods
    /**
     * @return User
     * @param int $id
     */
    public function setId(int $id) : User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return User
     * @param string $name
     */
    public function setName(string $name) : User
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
     * @param int|null $hesPartnerId
     */
    public function setHesPartnerId(?int $hesPartnerId) : User
    {
        $this->hesPartnerId = $hesPartnerId;
        return $this;
    }

    /**
     * @return User
     * @param int|null $performQAId
     */
    public function setPerformQAId(?int $performQAId) : User
    {
        $this->performQAId = $performQAId;
        return $this;
    }

    /**
     * @return User
     * @param int|null $qualityAssuranceProviderId
     */
    public function setQualityAssuranceProviderId(?int $qualityAssuranceProviderId) : User
    {
        $this->qualityAssuranceProviderId = $qualityAssuranceProviderId;
        return $this;
    }

    /**
     * @return User
     * @param bool $isBlocked
     */
    public function setIsBlocked(bool $isBlocked) : User
    {
        $this->isBlocked = $isBlocked;
        return $this;
    }

    /**
     * @return User
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created) : User
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return User
     * @param Company $company
     */
    public function setCompany(Company $company) : User
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

    /**
     * @return User
     * @param array $certifications
     */
    public function setCertifications(array $certifications) : User
    {
        $this->certifications = $certifications;
        return $this;
    }
 }