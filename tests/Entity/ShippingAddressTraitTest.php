<?php

namespace Loevgaard\AltaPay\Entity;

use PHPUnit\Framework\TestCase;

final class ShippingAddressTraitTest extends TestCase
{
    public function testGetters()
    {
        $xml = <<<XML
<CustomerInfo>
    <ShippingAddress>
        <Firstname>Palle</Firstname>
        <Lastname>Simonsen</Lastname>
        <Address>Rosenkæret 13</Address>
        <City>Søborg</City>
        <PostalCode>2860</PostalCode>
        <Country>DK</Country>
    </ShippingAddress>
</CustomerInfo>
XML;
        $xmlElement = new \SimpleXMLElement($xml);

        $mock = $this->getMockForTrait(ShippingAddressTrait::class);
        $mock->hydrateShippingAddress($xmlElement);

        $this->assertInstanceOf(ShippingAddress::class, $mock->getShippingAddress());
    }
}
