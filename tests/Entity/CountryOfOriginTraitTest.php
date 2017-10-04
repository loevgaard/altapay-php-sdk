<?php

namespace Loevgaard\AltaPay\Entity;

use PHPUnit\Framework\TestCase;

final class CountryOfOriginTraitTest extends TestCase
{
    public function testGetters()
    {
        $xml = <<<XML
<CustomerInfo>
    <CountryOfOrigin>
        <Country>DK</Country>
        <Source>BillingAddress</Source>
    </CountryOfOrigin>
</CustomerInfo>
XML;
        $xmlElement = new \SimpleXMLElement($xml);

        $mock = $this->getMockForTrait(CountryOfOriginTrait::class);
        $mock->hydrateCountryOfOrigin($xmlElement);

        $this->assertInstanceOf(CountryOfOrigin::class, $mock->getCountryOfOrigin());
    }
}
