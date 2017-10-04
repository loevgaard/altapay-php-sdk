<?php

namespace Loevgaard\AltaPay\Entity;

trait AddressTrait
{
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $country;

    /**
     * @return string
     */
    public function getFirstName() : string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName() : string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getAddress() : string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getCity() : string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getPostalCode() : string
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getCountry() : string
    {
        return $this->country;
    }

    /**
     * @param \SimpleXMLElement $xml
     */
    public function hydrateAddress(\SimpleXMLElement $xml)
    {
        $this->firstName = (string)$xml->Firstname;
        $this->lastName = (string)$xml->Lastname;
        $this->address = (string)$xml->Address;
        $this->city = (string)$xml->City;
        $this->postalCode = (string)$xml->PostalCode;
        $this->country = (string)$xml->Country;
    }
}
