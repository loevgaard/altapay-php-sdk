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

    /**
     * @param string $bankName
     * @param string $bankPhone
     * @param string $billingAddress
     * @param string $billingCity
     * @param string $billingCountry
     * @param string $billingFirstName
     * @param string $billingLastName
     * @param string $billingPostal
     * @param string $billingRegion
     * @param \DateTimeInterface $birthDate
     * @param string $customerPhone
     * @param string $email
     * @param string $gender
     * @param string $shippingAddress
     * @param string $shippingCity
     * @param string $shippingCountry
     * @param string $shippingFirstName
     * @param string $shippingLastName
     * @param string $shippingPostal
     * @param string $shippingRegion
     * @param string $username
     */
    public function __construct(
        ?string $bankName = null,
        ?string $bankPhone = null,
        ?string $billingAddress = null,
        ?string $billingCity = null,
        ?string $billingCountry = null,
        ?string $billingFirstName = null,
        ?string $billingLastName = null,
        ?string $billingPostal = null,
        ?string $billingRegion = null,
        ?\DateTimeInterface $birthDate = null,
        ?string $customerPhone = null,
        ?string $email = null,
        ?string $gender = null,
        ?string $shippingAddress = null,
        ?string $shippingCity = null,
        ?string $shippingCountry = null,
        ?string $shippingFirstName = null,
        ?string $shippingLastName = null,
        ?string $shippingPostal = null,
        ?string $shippingRegion = null,
        ?string $username = null
    ) {
        $this->setBankName($bankName);
        $this->setBankPhone($bankPhone);
        $this->setBillingAddress($billingAddress);
        $this->setBillingCity($billingCity);
        $this->setBillingCountry($billingCountry);
        $this->setBillingFirstName($billingFirstName);
        $this->setBillingLastName($billingLastName);
        $this->setBillingPostal($billingPostal);
        $this->setBillingRegion($billingRegion);
        $this->setBirthDate($birthDate);
        $this->setCustomerPhone($customerPhone);
        $this->setEmail($email);
        $this->setGender($gender);
        $this->setShippingAddress($shippingAddress);
        $this->setShippingCity($shippingCity);
        $this->setShippingCountry($shippingCountry);
        $this->setShippingFirstName($shippingFirstName);
        $this->setShippingLastName($shippingLastName);
        $this->setShippingPostal($shippingPostal);
        $this->setShippingRegion($shippingRegion);
        $this->setUsername($username);
    }


    public function getPayload() : array
    {
        $payload = [
            'bank_name' => $this->getBankName(),
            'bank_phone' => $this->getBankPhone(),
            'billing_address' => $this->getBillingAddress(),
            'billing_city' => $this->getBillingCity(),
            'billing_country' => $this->getBillingCountry(),
            'billing_firstname' => $this->getBillingFirstName(),
            'billing_lastname' => $this->getBillingLastName(),
            'billing_postal' => $this->getBillingPostal(),
            'billing_region' => $this->getBillingRegion(),
            'birthdate' => $this->getBirthDate() ? $this->getBirthDate()->format('Y-m-d') : null,
            'customer_phone' => $this->getCustomerPhone(),
            'email' => $this->getEmail(),
            'gender' => $this->getGender(),
            'shipping_address' => $this->getShippingAddress(),
            'shipping_city' => $this->getShippingCity(),
            'shipping_country' => $this->getShippingCountry(),
            'shipping_firstname' => $this->getShippingFirstName(),
            'shipping_lastname' => $this->getShippingLastName(),
            'shipping_postal' => $this->getShippingPostal(),
            'shipping_region' => $this->getShippingRegion(),
            'username' => $this->getUsername(),
        ];

        return $this->cleanPayload($payload);
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
    public function setBankName(?string $bankName) : self
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
    public function setBankPhone(?string $bankPhone) : self
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
    public function setBillingAddress(?string $billingAddress) : self
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
    public function setBillingCity(?string $billingCity) : self
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
    public function setBillingCountry(?string $billingCountry) : self
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
    public function setBillingFirstName(?string $billingFirstName) : self
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
    public function setBillingLastName(?string $billingLastName) : self
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
    public function setBillingPostal(?string $billingPostal) : self
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
    public function setBillingRegion(?string $billingRegion) : self
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
    public function setBirthDate(?\DateTimeInterface $birthDate) : self
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
    public function setCustomerPhone(?string $customerPhone) : self
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
    public function setEmail(?string $email) : self
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
    public function setGender(?string $gender) : self
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
    public function setShippingAddress(?string $shippingAddress) : self
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
    public function setShippingCity(?string $shippingCity) : self
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
    public function setShippingCountry(?string $shippingCountry) : self
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
    public function setShippingFirstName(?string $shippingFirstName) : self
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
    public function setShippingLastName(?string $shippingLastName) : self
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
    public function setShippingPostal(?string $shippingPostal) : self
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
    public function setShippingRegion(?string $shippingRegion) : self
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
    public function setUsername(?string $username) : self
    {
        $this->username = $username;
        return $this;
    }
}
