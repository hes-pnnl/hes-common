<?php

namespace HESCommon\Models;

/**
 * Class PublicProfile
 * User company information.
 */
class PublicProfile extends Model
{
    /** @var int|null */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $email;

    /** @var bool */
    private $published;

    /** @var Address */
    private $address;

    /** @var string|null */
    private $website;

    /** @var string|null */
    private $phone;

    /**
     * @param int $id
     * @return PublicProfile
     */
    public function setId(int $id): PublicProfile
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $name
     * @return PublicProfile
     */
    public function setName(string $name): PublicProfile
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $email
     * @return PublicProfile
     */
    public function setEmail(string $email): PublicProfile
    {
        $this->email = $email;
        return $this;
    }


    /**
     * @param bool $published
     * @return PublicProfile
     */
    public function setPublished(bool $published): PublicProfile
    {
        $this->published = $published;
        return $this;
    }

    /**
     * @param Address $address
     * @return PublicProfile
     */
    public function setAddress(Address $address): PublicProfile
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param string|null $website
     * @return PublicProfile
     */
    public function setWebsite(?string $website): PublicProfile
    {
        $this->website = $website;
        return $this;
    }

    /**
     * @param string|null $phone
     * @return PublicProfile
     */
    public function setPhone(?string $phone): PublicProfile
    {
        $this->phone = $phone;
        return $this;
    }


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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function getPublished(): bool
    {
        return $this->published;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }
}