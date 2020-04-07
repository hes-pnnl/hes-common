<?php
namespace HESCommon\Models;

/**
 * Class Company
 * User company information.
 */
class Company extends Model
{
    
    /** @var string */
    private $name;

    /** @var Address */
    private $address;

    /** @var string */
    private $phone;

    /**
     * @param string $name
     * @return Company
     */
    public function setName(string $name): Company
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param Address $address
     * @return Company
     */
    public function setAddress(Address $address): Company
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param string $phone
     * @return Company
     */
    public function setPhone(string $phone): Company
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
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
    public function getPhone(): string
    {
        return $this->phone;
    }
}