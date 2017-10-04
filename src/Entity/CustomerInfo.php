<?php
namespace Loevgaard\AltaPay\Entity;

use Loevgaard\AltaPay\Hydrator\HydratableInterface;

class CustomerInfo implements HydratableInterface
{
    use CountryOfOriginTrait;
    use BillingAddressTrait;
    use ShippingAddressTrait;
    use RegisteredAddressTrait;

    /**
     * @var string
     */
    private $userAgent;

    /**
     * @var string
     */
    private $ipAddress;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $customerPhone;

    /**
     * @var string
     */
    private $organisationNumber;

    /**
     * @var string
     */
    private $shippingAddress;

    /**
     * @var string
     */
    private $registeredAddress;
    
    public function hydrateXml(\SimpleXMLElement $xml)
    {
        if(!isset($xml->CustomerInfo)) {
            return;
        }

        /** @var \SimpleXMLElement $customerInfo */
        $customerInfo = $xml->CustomerInfo;
        
        $this->userAgent = (string)$customerInfo->UserAgent;
        $this->ipAddress = (string)$customerInfo->IpAddress;
        $this->email = (string)$customerInfo->Email;
        $this->username = (string)$customerInfo->Username;
        $this->customerPhone = (string)$customerInfo->CustomerPhone;
        $this->organisationNumber = (string)$customerInfo->OrganisationNumber;
        $this->hydrateCountryOfOrigin($customerInfo);
        $this->hydrateBillingAddress($customerInfo);
        $this->hydrateShippingAddress($customerInfo);
        $this->hydrateRegisteredAddress($customerInfo);
    }

    /**
     * @return string
     */
    public function getUserAgent() : string
    {
        return $this->userAgent;
    }

    /**
     * @return string
     */
    public function getIpAddress() : string
    {
        return $this->ipAddress;
    }

    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getUsername() : string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getCustomerPhone() : string
    {
        return $this->customerPhone;
    }

    /**
     * @return string
     */
    public function getOrganisationNumber() : string
    {
        return $this->organisationNumber;
    }

    /**
     * @return BillingAddress
     */
    public function getBillingAddress() : BillingAddress
    {
        return $this->billingAddress;
    }

    /**
     * @return string
     */
    public function getShippingAddress() : string
    {
        return $this->shippingAddress;
    }

    /**
     * @return string
     */
    public function getRegisteredAddress() : string
    {
        return $this->registeredAddress;
    }
}
