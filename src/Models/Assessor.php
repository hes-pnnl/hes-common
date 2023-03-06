<?php

namespace HESCommon\Models;

/**
 * Class Assessor - Contains the Assessor information.
 */
class Assessor extends Model
{

    /** @var int|null */
    protected $id;

    /** @var int|null */
    protected $userId;

    /** @var string user name */
    protected $name;

    /** @var string */
    protected $fullName;

    /** @var string|null hashed password */
    protected $password;

    /** @var string */
    protected $email;

    /** @var int|null */
    protected $hesPartnerId;

    /** @var int|null */
    protected $qualityAssuranceProviderId;

    /** @var bool */
    protected $alwaysActive = false;

    /** @var bool */
    protected $isPartner = false;

    //Getter methods

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
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
    public function getPassword(): ?string
    {
        return $this->password;
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
     * @return int|null
     */
    public function getQualityAssuranceProviderId() : ?int
    {
        return $this->qualityAssuranceProviderId;
    }

    /**
     * @return bool
     */
    public function isAlwaysActive() : bool
    {
        return $this->alwaysActive;
    }

    /**
     * @return bool
     */
    public function isPartner() : bool
    {
        return $this->isPartner;
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
     * @param int $userId
     * @return Assessor
     */
    public function setUserId(int $userId): Assessor
    {
        $this->userId = $userId;
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
     * @param string $password
     * @return Assessor
     */
    public function setPassword(string $password): Assessor
    {
        $this->password = $password;
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
     * @return User
     * @param int|null $qualityAssuranceProviderId
     */
    public function setQualityAssuranceProviderId(?int $qualityAssuranceProviderId) : Assessor
    {
        $this->qualityAssuranceProviderId = $qualityAssuranceProviderId;
        return $this;
    }

    /**
     * @return User
     * @param bool $alwaysActive
     */
    public function setAlwaysActive(?bool $alwaysActive) : Assessor
    {
        $this->alwaysActive = $alwaysActive || false;
        return $this;
    }

    /**
     * @return User
     * @param bool $isPartner
     */
    public function setIsPartner(?bool $isPartner) : Assessor
    {
        $this->isPartner = $isPartner || false;
        return $this;
    }
}