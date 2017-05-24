<?php
namespace Loevgaard\AltaPay\Payload\PaymentRequest;

use Loevgaard\AltaPay\Payload\Payload;

class CustomerInfo extends Payload implements CustomerInfoInterface
{
    CONST GENDER_MALE = 'male';
    CONST GENDER_FEMALE = 'female';

    /**
     * @var string
     */
    private $bankName;

    /**
     * @var string
     */
    private $bankPhone;

    /**
     * @var string
     */
    private $billingAddress;

    /**
     * @var string
     */
    private $billingCity;

    /**
     * @var string
     */
    private $billingCountry;

    /**
     * @var string
     */
    private $billingFirstName;

    /**
     * @var string
     */
    private $billingLastName;

    /**
     * @var string
     */
    private $billingPostal;

    /**
     * @var string
     */
    private $billingRegion;

    /**
     * @var string
     */
    private $birthDate;

    /**
     * @var string
     */
    private $customerPhone;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var string
     */
    private $shippingAddress;

    /**
     * @var string
     */
    private $shippingCity;

    /**
     * @var string
     */
    private $shippingCountry;

    /**
     * @var string
     */
    private $shippingFirstName;

    /**
     * @var string
     */
    private $shippingLastName;

    /**
     * @var string
     */
    private $shippingPostal;

    /**
     * @var string
     */
    private $shippingRegion;

    /**
     * @var string
     */
    private $username;

    public function getPayload()
    {
        $payload = [
            'bank_name' => $this->bankName,
            'bank_phone' => $this->bankPhone,
            'billing_address' => $this->billingAddress,
            'billing_city' => $this->billingCity,
            'billing_country' => $this->billingCountry,
            'billing_firstname' => $this->billingFirstName,
            'billing_lastname' => $this->billingLastName,
            'billing_postal' => $this->billingPostal,
            'billing_region' => $this->billingRegion,
            'birthdate' => $this->birthDate,
            'customer_phone' => $this->customerPhone,
            'email' => $this->email,
            'gender' => $this->gender,
            'shipping_address' => $this->shippingAddress,
            'shipping_city' => $this->shippingCity,
            'shipping_country' => $this->shippingCountry,
            'shipping_firstname' => $this->shippingFirstName,
            'shipping_lastname' => $this->shippingLastName,
            'shipping_postal' => $this->shippingPostal,
            'shipping_region' => $this->shippingRegion,
            'username' => $this->username,
        ];

        return $this->cleanPayload($payload);
    }

    /**
     * @return string
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * @param string $bankName
     * @return CustomerInfo
     */
    public function setBankName($bankName)
    {
        $this->bankName = $bankName;
        return $this;
    }

    /**
     * @return string
     */
    public function getBankPhone()
    {
        return $this->bankPhone;
    }

    /**
     * @param string $bankPhone
     * @return CustomerInfo
     */
    public function setBankPhone($bankPhone)
    {
        $this->bankPhone = $bankPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @param string $billingAddress
     * @return CustomerInfo
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingCity()
    {
        return $this->billingCity;
    }

    /**
     * @param string $billingCity
     * @return CustomerInfo
     */
    public function setBillingCity($billingCity)
    {
        $this->billingCity = $billingCity;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingCountry()
    {
        return $this->billingCountry;
    }

    /**
     * @param string $billingCountry
     * @return CustomerInfo
     */
    public function setBillingCountry($billingCountry)
    {
        $this->billingCountry = $billingCountry;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingFirstName()
    {
        return $this->billingFirstName;
    }

    /**
     * @param string $billingFirstName
     * @return CustomerInfo
     */
    public function setBillingFirstName($billingFirstName)
    {
        $this->billingFirstName = $billingFirstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingLastName()
    {
        return $this->billingLastName;
    }

    /**
     * @param string $billingLastName
     * @return CustomerInfo
     */
    public function setBillingLastName($billingLastName)
    {
        $this->billingLastName = $billingLastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingPostal()
    {
        return $this->billingPostal;
    }

    /**
     * @param string $billingPostal
     * @return CustomerInfo
     */
    public function setBillingPostal($billingPostal)
    {
        $this->billingPostal = $billingPostal;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingRegion()
    {
        return $this->billingRegion;
    }

    /**
     * @param string $billingRegion
     * @return CustomerInfo
     */
    public function setBillingRegion($billingRegion)
    {
        $this->billingRegion = $billingRegion;
        return $this;
    }

    /**
     * @return string
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param string $birthDate
     * @return CustomerInfo
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerPhone()
    {
        return $this->customerPhone;
    }

    /**
     * @param string $customerPhone
     * @return CustomerInfo
     */
    public function setCustomerPhone($customerPhone)
    {
        $this->customerPhone = $customerPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return CustomerInfo
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return CustomerInfo
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

    /**
     * @param string $shippingAddress
     * @return CustomerInfo
     */
    public function setShippingAddress($shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingCity()
    {
        return $this->shippingCity;
    }

    /**
     * @param string $shippingCity
     * @return CustomerInfo
     */
    public function setShippingCity($shippingCity)
    {
        $this->shippingCity = $shippingCity;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingCountry()
    {
        return $this->shippingCountry;
    }

    /**
     * @param string $shippingCountry
     * @return CustomerInfo
     */
    public function setShippingCountry($shippingCountry)
    {
        $this->shippingCountry = $shippingCountry;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingFirstName()
    {
        return $this->shippingFirstName;
    }

    /**
     * @param string $shippingFirstName
     * @return CustomerInfo
     */
    public function setShippingFirstName($shippingFirstName)
    {
        $this->shippingFirstName = $shippingFirstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingLastName()
    {
        return $this->shippingLastName;
    }

    /**
     * @param string $shippingLastName
     * @return CustomerInfo
     */
    public function setShippingLastName($shippingLastName)
    {
        $this->shippingLastName = $shippingLastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingPostal()
    {
        return $this->shippingPostal;
    }

    /**
     * @param string $shippingPostal
     * @return CustomerInfo
     */
    public function setShippingPostal($shippingPostal)
    {
        $this->shippingPostal = $shippingPostal;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingRegion()
    {
        return $this->shippingRegion;
    }

    /**
     * @param string $shippingRegion
     * @return CustomerInfo
     */
    public function setShippingRegion($shippingRegion)
    {
        $this->shippingRegion = $shippingRegion;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return CustomerInfo
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
}