<?php

namespace HESCommon\Models;

/**
 * Class PublickProfile
 * User company information.
 */
class PublickProfile extends Model
{
    /** @var int|null */
    private $id;

    /** @var int */
    private $userId;

    /** @var string */
    private $name;

    /** @var bool */
    private $published;

    /** @var Address */
    private $address;

    /** @var string */
    private $website;

    /**
     * @param int $id
     * @return PublickProfile
     */
    public function setId(int $id): PublickProfile
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param int $userId
     * @return PublickProfile
     */
    public function setUserId(int $userId): PublickProfile
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @param string $name
     * @return PublickProfile
     */
    public function setName(string $name): PublickProfile
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param bool $published
     * @return PublickProfile
     */
    public function setPublished(bool $published): PublickProfile
    {
        $this->published = $published;
        return $this;
    }

    /**
     * @param Address $address
     * @return PublickProfile
     */
    public function setAddress(Address $address): PublickProfile
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param string $website
     * @return PublickProfile
     */
    public function setWebsite(string $website): PublickProfile
    {
        $this->website = $website;
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
     * @return int
     */
    public function getUserId(): int
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
     * @return string
     */
    public function getWebsite(): string
    {
        return $this->website;
    }
}