<?php

namespace Loevgaard\AltaPay\Entity;

use PHPUnit\Framework\TestCase;

final class BillingAddressTest extends TestCase
{
    public function testHydrate1()
    {
        $xml = <<<XML
<CustomerInfo>
    <BillingAddress>
        <Firstname>Palle</Firstname>
        <Lastname>Simonsen</Lastname>
        <Address>Rosenkæret 13</Address>
        <City>Søborg</City>
        <PostalCode>2860</PostalCode>
        <Country>DK</Country>
    </BillingAddress>
</CustomerInfo>
XML;
        $xmlElement = new \SimpleXMLElement($xml);

        $entity = new BillingAddress();
        $entity->hydrateXml($xmlElement);

        $this->assertSame('Palle', $entity->getFirstName());
        $this->assertSame('Simonsen', $entity->getLastName());
        $this->assertSame('Rosenkæret 13', $entity->getAddress());
        $this->assertSame('Søborg', $entity->getCity());
        $this->assertSame('2860', $entity->getPostalCode());
        $this->assertSame('DK', $entity->getCountry());
    }

    public function testHydrate2()
    {
        $xml = '<CustomerInfo></CustomerInfo>';
        $xmlElement = new \SimpleXMLElement($xml);

        $entity = new BillingAddress();
        $entity->hydrateXml($xmlElement);

        $this->assertSame(null, $entity->getFirstName());
        $this->assertSame(null, $entity->getLastName());
        $this->assertSame(null, $entity->getAddress());
        $this->assertSame(null, $entity->getCity());
        $this->assertSame(null, $entity->getPostalCode());
        $this->assertSame(null, $entity->getCountry());
    }
}
