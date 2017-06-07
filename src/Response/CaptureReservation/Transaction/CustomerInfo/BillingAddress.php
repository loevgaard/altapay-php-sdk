<?php
namespace Loevgaard\AltaPay\Response\CaptureReservation\Transaction\CustomerInfo;

use Loevgaard\AltaPay\Response\PartialResponse;

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

    protected function init()
    {
        $this->firstName = (string)$this->xmlDoc->Firstname;
        $this->lastName = (string)$this->xmlDoc->Lastname;
        $this->address = (string)$this->xmlDoc->Address;
        $this->city = (string)$this->xmlDoc->City;
        $this->postalCode = (string)$this->xmlDoc->PostalCode;
        $this->country = (string)$this->xmlDoc->Country;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }
}
