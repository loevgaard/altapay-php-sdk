<?php
namespace Loevgaard\AltaPay\Response\CaptureReservation\Transaction;

use Loevgaard\AltaPay\Response\CaptureReservation\Transaction\CustomerInfo\BillingAddress;
use Loevgaard\AltaPay\Response\CaptureReservation\Transaction\CustomerInfo\CountryOfOrigin;
use Loevgaard\AltaPay\Response\PartialResponse;

class CustomerInfo extends PartialResponse
{
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
     * @var CountryOfOrigin
     */
    private $countryOfOrigin;

    /**
     * @var BillingAddress
     */
    private $billingAddress;

    /**
     * @var string
     */
    private $shippingAddress;

    /**
     * @var string
     */
    private $registeredAddress;

    protected function init()
    {
        $this->userAgent = (string)$this->xmlDoc->UserAgent;
        $this->ipAddress = (string)$this->xmlDoc->IpAddress;
        $this->email = (string)$this->xmlDoc->Email;
        $this->username = (string)$this->xmlDoc->Username;
        $this->customerPhone = (string)$this->xmlDoc->CustomerPhone;
        $this->organisationNumber = (string)$this->xmlDoc->OrganisationNumber;

        // @todo these two properties should probably have their own objects,
        // but I am awaiting a response from Altapay regarding the possible contents of these
        // since the documentation does not say anything about it:
        // https://testgateway.altapaysecure.com/merchant/help/Merchant_API#API_captureReservation
        $this->shippingAddress = (string)$this->xmlDoc->ShippingAddress;
        $this->registeredAddress = (string)$this->xmlDoc->RegisteredAddress;

        // populating country of origin object
        $this->countryOfOrigin = new CountryOfOrigin($this->getOriginalResponse(), $this->xmlDoc->CountryOfOrigin);

        // populating billing address object
        $this->billingAddress = new BillingAddress($this->getOriginalResponse(), $this->xmlDoc->BillingAddress);
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
     * @return CountryOfOrigin
     */
    public function getCountryOfOrigin() : CountryOfOrigin
    {
        return $this->countryOfOrigin;
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
