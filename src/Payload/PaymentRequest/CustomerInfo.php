<?php
namespace Loevgaard\AltaPay\Payload\PaymentRequest;

use Assert\Assert;
use Loevgaard\AltaPay\Payload\Payload;

class CustomerInfo extends Payload implements CustomerInfoInterface
{
    const GENDER_MALE = 'male';
    const GENDER_MALE_2 = 'm';
    const GENDER_FEMALE = 'female';
    const GENDER_FEMALE_2 = 'f';

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
     * @var \DateTimeInterface
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

    public function getPayload() : array
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
            'birthdate' => $this->birthDate ? $this->birthDate->format('Y-m-d') : null,
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

        $this->validate();

        return static::simplePayload($payload);
    }

    public function validate()
    {
        Assert::thatNullOr($this->bankName)->string();
        Assert::thatNullOr($this->bankPhone)->string();
        Assert::thatNullOr($this->billingAddress)->string();
        Assert::thatNullOr($this->billingCity)->string();
        Assert::thatNullOr($this->billingCountry)->string();
        Assert::thatNullOr($this->billingFirstName)->string();
        Assert::thatNullOr($this->billingLastName)->string();
        Assert::thatNullOr($this->billingPostal)->string();
        Assert::thatNullOr($this->billingRegion)->string();
        Assert::thatNullOr($this->birthDate)->isInstanceOf(\DateTimeInterface::class);
        Assert::thatNullOr($this->customerPhone)->string();
        Assert::thatNullOr($this->email)->email();
        Assert::thatNullOr($this->gender)->inArray(static::getGenders());
        Assert::thatNullOr($this->shippingAddress)->string();
        Assert::thatNullOr($this->shippingCity)->string();
        Assert::thatNullOr($this->shippingCountry)->string();
        Assert::thatNullOr($this->shippingFirstName)->string();
        Assert::thatNullOr($this->shippingLastName)->string();
        Assert::thatNullOr($this->shippingPostal)->string();
        Assert::thatNullOr($this->shippingRegion)->string();
        Assert::thatNullOr($this->username)->string();
    }

    public static function getGenders() : array
    {
        return [
            self::GENDER_MALE,
            self::GENDER_MALE_2,
            self::GENDER_FEMALE,
            self::GENDER_FEMALE_2,
        ];
    }

    /**
     * @return string
     */
    public function getBankName() : ?string
    {
        return $this->bankName;
    }

    /**
     * @param string $bankName
     * @return CustomerInfo
     */
    public function setBankName(string $bankName) : self
    {
        $this->bankName = $bankName;
        return $this;
    }

    /**
     * @return string
     */
    public function getBankPhone() : ?string
    {
        return $this->bankPhone;
    }

    /**
     * @param string $bankPhone
     * @return CustomerInfo
     */
    public function setBankPhone(string $bankPhone) : self
    {
        $this->bankPhone = $bankPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingAddress() : ?string
    {
        return $this->billingAddress;
    }

    /**
     * @param string $billingAddress
     * @return CustomerInfo
     */
    public function setBillingAddress(string $billingAddress) : self
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingCity() : ?string
    {
        return $this->billingCity;
    }

    /**
     * @param string $billingCity
     * @return CustomerInfo
     */
    public function setBillingCity(string $billingCity) : self
    {
        $this->billingCity = $billingCity;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingCountry() : ?string
    {
        return $this->billingCountry;
    }

    /**
     * @param string $billingCountry
     * @return CustomerInfo
     */
    public function setBillingCountry(string $billingCountry) : self
    {
        $this->billingCountry = $billingCountry;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingFirstName() : ?string
    {
        return $this->billingFirstName;
    }

    /**
     * @param string $billingFirstName
     * @return CustomerInfo
     */
    public function setBillingFirstName(string $billingFirstName) : self
    {
        $this->billingFirstName = $billingFirstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingLastName() : ?string
    {
        return $this->billingLastName;
    }

    /**
     * @param string $billingLastName
     * @return CustomerInfo
     */
    public function setBillingLastName(string $billingLastName) : self
    {
        $this->billingLastName = $billingLastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingPostal() : ?string
    {
        return $this->billingPostal;
    }

    /**
     * @param string $billingPostal
     * @return CustomerInfo
     */
    public function setBillingPostal(string $billingPostal) : self
    {
        $this->billingPostal = $billingPostal;
        return $this;
    }

    /**
     * @return string
     */
    public function getBillingRegion() : ?string
    {
        return $this->billingRegion;
    }

    /**
     * @param string $billingRegion
     * @return CustomerInfo
     */
    public function setBillingRegion(string $billingRegion) : self
    {
        $this->billingRegion = $billingRegion;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTimeInterface $birthDate
     * @return CustomerInfo
     */
    public function setBirthDate(\DateTimeInterface $birthDate) : self
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerPhone() : ?string
    {
        return $this->customerPhone;
    }

    /**
     * @param string $customerPhone
     * @return CustomerInfo
     */
    public function setCustomerPhone(string $customerPhone) : self
    {
        $this->customerPhone = $customerPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail() : ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return CustomerInfo
     */
    public function setEmail(string $email) : self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender() : ?string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return CustomerInfo
     */
    public function setGender(string $gender) : self
    {
        Assert::that($gender)->nullOr()->inArray(static::getGenders());
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingAddress() : ?string
    {
        return $this->shippingAddress;
    }

    /**
     * @param string $shippingAddress
     * @return CustomerInfo
     */
    public function setShippingAddress(string $shippingAddress) : self
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingCity() : ?string
    {
        return $this->shippingCity;
    }

    /**
     * @param string $shippingCity
     * @return CustomerInfo
     */
    public function setShippingCity(string $shippingCity) : self
    {
        $this->shippingCity = $shippingCity;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingCountry() : ?string
    {
        return $this->shippingCountry;
    }

    /**
     * @param string $shippingCountry
     * @return CustomerInfo
     */
    public function setShippingCountry(string $shippingCountry) : self
    {
        $this->shippingCountry = $shippingCountry;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingFirstName() : ?string
    {
        return $this->shippingFirstName;
    }

    /**
     * @param string $shippingFirstName
     * @return CustomerInfo
     */
    public function setShippingFirstName(string $shippingFirstName) : self
    {
        $this->shippingFirstName = $shippingFirstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingLastName() : ?string
    {
        return $this->shippingLastName;
    }

    /**
     * @param string $shippingLastName
     * @return CustomerInfo
     */
    public function setShippingLastName(string $shippingLastName) : self
    {
        $this->shippingLastName = $shippingLastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingPostal() : ?string
    {
        return $this->shippingPostal;
    }

    /**
     * @param string $shippingPostal
     * @return CustomerInfo
     */
    public function setShippingPostal(string $shippingPostal) : self
    {
        $this->shippingPostal = $shippingPostal;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingRegion() : ?string
    {
        return $this->shippingRegion;
    }

    /**
     * @param string $shippingRegion
     * @return CustomerInfo
     */
    public function setShippingRegion(string $shippingRegion) : self
    {
        $this->shippingRegion = $shippingRegion;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername() : ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return CustomerInfo
     */
    public function setUsername(string $username) : self
    {
        $this->username = $username;
        return $this;
    }
}
