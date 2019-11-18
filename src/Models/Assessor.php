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

    /** @var string */
    private $city;

    /** @var string */
    private $state;

    /** @var string */
    private $zip;

    /** @var string */
    protected $phone;

    /** @var string */
    protected $website;

    //Getter methods

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return int|null
     */
    public function getHesPartnerId(): ?int
    {
        return $this->hesPartnerId;
    }

    /**
     * @return \DateTime|null
     */
    public function getRoleCreated(): ?\DateTime
    {
        return $this->roleCreated;
    }

    /**
     * @return \DateTime|null
     */
    public function getRoleUpdated(): ?\DateTime
    {
        return $this->roleUpdated;
    }

    /**
     * @return \DateTime|null
     */
    public function getRoleDeactivated(): ?\DateTime
    {
        return $this->roleDeactivated;
    }


    /**
     * @return string
     */
    public function getCity(): String
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getState(): String
    {
        return $this->state;
    }


    /**
     * @return string
     */
    public function getZip(): String
    {
        return $this->zip;
    }

    /**
     * @return string
     */
    public function getPhone(): String
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getWebsite(): String
    {
        return $this->website;
    }


    //Setter methods

    /**
     * @param int $id
     * @return Assessor
     */
    public function setId(int $id): Assessor
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $name
     * @return Assessor
     */
    public function setName(string $name): Assessor
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $fullName
     * @return Assessor
     */
    public function setFullName(string $fullName): Assessor
    {
        $this->fullName = $fullName;
        return $this;
    }

    /**
     * @param string $email
     * @return Assessor
     */
    public function setEmail(string $email): Assessor
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param int|null $hesPartnerId
     * @return Assessor
     */
    public function setHesPartnerId(?int $hesPartnerId): Assessor
    {
        $this->hesPartnerId = $hesPartnerId;
        return $this;
    }

    /**
     * @param \DateTime|null $roleCreated
     * @return Assessor
     */
    public function setRoleCreated(?\DateTime $roleCreated): Assessor
    {
        $this->roleCreated = $roleCreated;
        return $this;
    }

    /**
     * @param \DateTime|null $roleUpdated
     * @return Assessor
     */
    public function setRoleUpdated(?\DateTime $roleUpdated): Assessor
    {
        $this->roleUpdated = $roleUpdated;
        return $this;
    }

    /**
     * @param \DateTime|null $roleDeactived
     * @return Assessor
     */
    public function setRoleDeactivated(?\DateTime $roleDeactived): Assessor
    {
        $this->roleDeactivated = $roleDeactived;
        return $this;
    }

    /**
     * @param string $city
     * @return Assessor
     */
    public function setCity($city): Assessor
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param string $state
     * @return Assessor
     */
    public function setState($state): Assessor
    {
        $this->state = strtoupper($state);
        return $this;
    }

    /**
     * @param string $zip
     * @return Assessor
     */
    public function setZip($zip): Assessor
    {
        $this->zip = $zip;
        return $this;
    }

    /**
     * @param string $phone
     * @return Assessor
     */
    public function setPhone($phone): Assessor
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param string $website
     * @return Assessor
     */
    public function setWebsite($website): Assessor
    {
        $this->website = $website;
        return $this;
    }
}