<?php
namespace Loevgaard\AltaPay\Payload\PaymentRequest;

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
        $bankName = null,
        $bankPhone = null,
        $billingAddress = null,
        $billingCity = null,
        $billingCountry = null,
        $billingFirstName = null,
        $billingLastName = null,
        $billingPostal = null,
        $billingRegion = null,
        $birthDate = null,
        $customerPhone = null,
        $email = null,
        $gender = null,
        $shippingAddress = null,
        $shippingCity = null,
        $shippingCountry = null,
        $shippingFirstName = null,
        $shippingLastName = null,
        $shippingPostal = null,
        $shippingRegion = null,
        $username = null
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


    public function getPayload()
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

    public static function getGenders()
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
        $this->assertStringOrNull($bankName);
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
        $this->assertStringOrNull($bankPhone);
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
        $this->assertStringOrNull($billingAddress);
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
        $this->assertStringOrNull($billingCity);
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
        $this->assertStringOrNull($billingCountry);
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
        $this->assertStringOrNull($billingFirstName);
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
        $this->assertStringOrNull($billingLastName);
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
        $this->assertStringOrNull($billingPostal);
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
        $this->assertStringOrNull($billingRegion);
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
    public function setBirthDate($birthDate)
    {
        $this->assertDateTimeOrNull($birthDate);
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
        $this->assertStringOrNull($customerPhone);
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
        $this->assertStringOrNull($email);
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
        $this->assertInArrayOrNull($gender, self::getGenders());
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
        $this->assertStringOrNull($shippingAddress);
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
        $this->assertStringOrNull($shippingCity);
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
        $this->assertStringOrNull($shippingCountry);
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
        $this->assertStringOrNull($shippingFirstName);
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
        $this->assertStringOrNull($shippingLastName);
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
        $this->assertStringOrNull($shippingPostal);
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
        $this->assertStringOrNull($shippingRegion);
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
        $this->assertStringOrNull($username);
        $this->username = $username;
        return $this;
    }
}
