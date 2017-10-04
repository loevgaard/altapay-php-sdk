<?php

namespace Loevgaard\AltaPay\Entity;

use PHPUnit\Framework\TestCase;

final class CountryOfOriginTest extends TestCase
{
    public function testHydrate1()
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

        $entity = new CountryOfOrigin();
        $entity->hydrateXml($xmlElement);

        $this->assertSame('DK', $entity->getCountry());
        $this->assertSame('BillingAddress', $entity->getSource());
    }

    public function testHydrate2()
    {
        $xml = '<CustomerInfo></CustomerInfo>';
        $xmlElement = new \SimpleXMLElement($xml);

        $entity = new CountryOfOrigin();
        $entity->hydrateXml($xmlElement);

        $this->assertSame(null, $entity->getCountry());
        $this->assertSame(null, $entity->getSource());
    }
}
