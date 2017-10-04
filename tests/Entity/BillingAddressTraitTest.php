<?php

namespace Loevgaard\AltaPay\Entity;

use PHPUnit\Framework\TestCase;

final class BillingAddressTraitTest extends TestCase
{
    public function testGetters()
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

        $mock = $this->getMockForTrait(BillingAddressTrait::class);
        $mock->hydrateBillingAddress($xmlElement);

        $this->assertInstanceOf(BillingAddress::class, $mock->getBillingAddress());
    }
}
