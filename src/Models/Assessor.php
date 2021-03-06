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
}