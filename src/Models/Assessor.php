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

    /** @var bool */
    protected $disableHescoreGUIAccess = false;

    /** @var bool */
    protected $hasProductionAccess = true;

    /** @var bool */
    protected $hasSandboxAccess = false;

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
    public function getDisableHescoreGUIAccess() : bool
    {
        return $this->disableHescoreGUIAccess;
    }

    /**
     * @return bool
     */
    public function getHasProductionAccess() : bool
    {
        return $this->hasProductionAccess;
    }

    /**
     * @return bool
     */
    public function getHasSandboxAccess() : bool
    {
        return $this->hasSandboxAccess;
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
     * @param int|null $qualityAssuranceProviderId
     * @return Assessor
     */
    public function setQualityAssuranceProviderId(?int $qualityAssuranceProviderId) : Assessor
    {
        $this->qualityAssuranceProviderId = $qualityAssuranceProviderId;
        return $this;
    }

    /**
     * @param bool $alwaysActive
     * @return Assessor
     */
    public function setAlwaysActive(?bool $alwaysActive) : Assessor
    {
        $this->alwaysActive = $alwaysActive || false;
        return $this;
    }

    /**
     * @param bool $disableHescoreGUIAccess
     * @return Assessor
     */
    public function setDisableHescoreGUIAccess(bool $disableHescoreGUIAccess) : Assessor
    {
        $this->disableHescoreGUIAccess = $disableHescoreGUIAccess;
        return $this;
    }

    /**
     * @param bool $hasProductionAccess
     *@return Assessor
     */
    public function setHasProductionAccess(bool $hasProductionAccess) : Assessor
    {
        $this->hasProductionAccess = $hasProductionAccess;
        return $this;
    }

    /**
     * @param bool $hasSandboxAccess
     * @return Assessor
     */
    public function setHasSandboxAccess(bool $hasSandboxAccess) : Assessor
    {
        $this->hasSandboxAccess = $hasSandboxAccess;
        return $this;
    }

    /**
     * @param bool $isPartner
     * @return Assessor
     */
    public function setIsPartner(?bool $isPartner) : Assessor
    {
        $this->isPartner = $isPartner || false;
        return $this;
    }
}