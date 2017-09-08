<?php
namespace Loevgaard\AltaPay\Response\Partial\Transaction\CustomerInfo;

use Loevgaard\AltaPay\Response\Partial\PartialResponse;

class BillingAddress extends PartialResponse
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

    protected function init()
    {
        $this->firstName = (string)$this->xmlDoc->Firstname;
        $this->lastName = (string)$this->xmlDoc->Lastname;
        $this->address = (string)$this->xmlDoc->Address;
        $this->city = (string)$this->xmlDoc->City;
        $this->postalCode = (string)$this->xmlDoc->PostalCode;
        $this->country = (string)$this->xmlDoc->Country;
    }
}
