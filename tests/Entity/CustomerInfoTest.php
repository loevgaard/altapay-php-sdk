<?php

namespace Loevgaard\AltaPay\Entity;

use PHPUnit\Framework\TestCase;

final class CustomerInfoTest extends TestCase
{
    public function testHydrate1()
    {
        $xml = <<<XML
<Transaction>
    <CustomerInfo>
        <UserAgent>Mozilla/5.0</UserAgent>
        <IpAddress>127.127.127.127</IpAddress>
        <Email>support@altapay.com</Email>
        <Username>support</Username>
        <CustomerPhone>+45 7020 0056</CustomerPhone>
        <OrganisationNumber>12345678</OrganisationNumber>
        <CountryOfOrigin>
            <Country>DK</Country>
            <Source>BillingAddress</Source>
        </CountryOfOrigin>
        <BillingAddress>
            <Firstname>Palle</Firstname>
            <Lastname>Simonsen</Lastname>
            <Address>Rosenkæret 13</Address>
            <City>Søborg</City>
            <PostalCode>2860</PostalCode>
            <Country>DK</Country>
        </BillingAddress>
    </CustomerInfo>
</Transaction>
XML;
        $xmlElement = new \SimpleXMLElement($xml);

        $entity = new CustomerInfo();
        $entity->hydrateXml($xmlElement);

        $this->assertSame('Mozilla/5.0', $entity->getUserAgent());
        $this->assertSame('127.127.127.127', $entity->getIpAddress());
        $this->assertSame('support@altapay.com', $entity->getEmail());
        $this->assertSame('support', $entity->getUsername());
        $this->assertSame('+45 7020 0056', $entity->getCustomerPhone());
        $this->assertSame('12345678', $entity->getOrganisationNumber());
    }

    public function testHydrate2()
    {
        $xml = '<Transaction></Transaction>';
        $xmlElement = new \SimpleXMLElement($xml);

        $entity = new CustomerInfo();
        $entity->hydrateXml($xmlElement);

        $this->assertSame(null, $entity->getUserAgent());
        $this->assertSame(null, $entity->getIpAddress());
        $this->assertSame(null, $entity->getEmail());
        $this->assertSame(null, $entity->getUsername());
        $this->assertSame(null, $entity->getCustomerPhone());
        $this->assertSame(null, $entity->getOrganisationNumber());
    }
}
