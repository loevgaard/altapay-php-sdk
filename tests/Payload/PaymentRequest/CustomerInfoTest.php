<?php

namespace Loevgaard\AltaPay\Payload\PaymentRequest;

use PHPUnit\Framework\TestCase;

final class CustomerInfoTest extends TestCase
{
    public function testGettersSetters()
    {
        $birthDate = \DateTime::createFromFormat('Y-m-d', '2000-01-01');
        $customerInfo = new CustomerInfo();
        $customerInfo
            ->setBankName('bankname')
            ->setBankPhone('bankphone')
            ->setBillingAddress('billingaddress')
            ->setBillingCity('billingcity')
            ->setBillingCountry('billingcountry')
            ->setBillingFirstName('billingfirstname')
            ->setBillingLastName('billinglastname')
            ->setBillingPostal('billingpostal')
            ->setBillingRegion('billingregion')
            ->setBirthDate($birthDate)
            ->setCustomerPhone('customerphone')
            ->setEmail('email')
            ->setGender(CustomerInfo::GENDER_MALE)
            ->setShippingAddress('shippingaddress')
            ->setShippingCity('shippingcity')
            ->setShippingCountry('shippingcountry')
            ->setShippingFirstName('shippingfirstname')
            ->setShippingLastName('shippinglastname')
            ->setShippingPostal('shippingpostal')
            ->setShippingRegion('shippingregion')
            ->setUsername('username')
        ;

        $this->assertSame('bankname', $customerInfo->getBankName());
        $this->assertSame('bankphone', $customerInfo->getBankPhone());
        $this->assertSame('billingaddress', $customerInfo->getBillingAddress());
        $this->assertSame('billingcity', $customerInfo->getBillingCity());
        $this->assertSame('billingcountry', $customerInfo->getBillingCountry());
        $this->assertSame('billingfirstname', $customerInfo->getBillingFirstName());
        $this->assertSame('billinglastname', $customerInfo->getBillingLastName());
        $this->assertSame('billingpostal', $customerInfo->getBillingPostal());
        $this->assertSame('billingregion', $customerInfo->getBillingRegion());
        $this->assertSame($birthDate, $customerInfo->getBirthDate());
        $this->assertSame('customerphone', $customerInfo->getCustomerPhone());
        $this->assertSame('email', $customerInfo->getEmail());
        $this->assertSame(CustomerInfo::GENDER_MALE, $customerInfo->getGender());
        $this->assertSame('shippingaddress', $customerInfo->getShippingAddress());
        $this->assertSame('shippingcity', $customerInfo->getShippingCity());
        $this->assertSame('shippingcountry', $customerInfo->getShippingCountry());
        $this->assertSame('shippingfirstname', $customerInfo->getShippingFirstName());
        $this->assertSame('shippinglastname', $customerInfo->getShippingLastName());
        $this->assertSame('shippingpostal', $customerInfo->getShippingPostal());
        $this->assertSame('shippingregion', $customerInfo->getShippingRegion());
        $this->assertSame('username', $customerInfo->getUsername());
    }
}
