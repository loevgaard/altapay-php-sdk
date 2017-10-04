<?php

namespace Loevgaard\AltaPay\Entity;

use PHPUnit\Framework\TestCase;

final class RegisteredAddressTraitTest extends TestCase
{
    public function testGetters()
    {
        $xml = <<<XML
<CustomerInfo>
    <RegisteredAddress>
        <Firstname>Palle</Firstname>
        <Lastname>Simonsen</Lastname>
        <Address>Rosenkæret 13</Address>
        <City>Søborg</City>
        <PostalCode>2860</PostalCode>
        <Country>DK</Country>
    </RegisteredAddress>
</CustomerInfo>
XML;
        $xmlElement = new \SimpleXMLElement($xml);

        $mock = $this->getMockForTrait(RegisteredAddressTrait::class);
        $mock->hydrateRegisteredAddress($xmlElement);

        $this->assertInstanceOf(RegisteredAddress::class, $mock->getRegisteredAddress());
    }
}
