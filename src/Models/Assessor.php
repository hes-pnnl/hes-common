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

    /** @var string|null */
    private $city;

    /** @var string|null */
    private $state;

    /** @var string|null */
    private $zip;

    /** @var string|null */
    protected $phone;

    /** @var string|null */
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
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }


    /**
     * @return string|null
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return string|null
     */
    public function getWebsite(): ?string
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
     * @param string|null $city
     * @return Assessor
     */
    public function setCity(?string $city): Assessor
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param string|null $state
     * @return Assessor
     */
    public function setState(?string $state): Assessor
    {
        $this->state = strtoupper($state);
        return $this;
    }

    /**
     * @param string|null $zip
     * @return Assessor
     */
    public function setZip(?string $zip): Assessor
    {
        $this->zip = $zip;
        return $this;
    }

    /**
     * @param string|null $phone
     * @return Assessor
     */
    public function setPhone(?string $phone): Assessor
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param string|null $website
     * @return Assessor
     */
    public function setWebsite(?string $website): Assessor
    {
        $this->website = $website;
        return $this;
    }
}