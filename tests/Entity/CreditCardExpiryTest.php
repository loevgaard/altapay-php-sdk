<?php

namespace Loevgaard\AltaPay\Entity;

use PHPUnit\Framework\TestCase;

final class CreditCardExpiryTest extends TestCase
{
    public function testHydrate1()
    {
        $xml = <<<XML
<Transaction>
    <CreditCardExpiry>
        <Year>2017</Year>
        <Month>09</Month>
    </CreditCardExpiry>
</Transaction>
XML;
        $xmlElement = new \SimpleXMLElement($xml);

        $entity = new CreditCardExpiry();
        $entity->hydrateXml($xmlElement);

        $this->assertSame(2017, $entity->getYear());
        $this->assertSame(9, $entity->getMonth());
    }

    public function testHydrate2()
    {
        $xml = '<Transaction></Transaction>';
        $xmlElement = new \SimpleXMLElement($xml);

        $entity = new CreditCardExpiry();
        $entity->hydrateXml($xmlElement);

        $this->assertSame(null, $entity->getYear());
        $this->assertSame(null, $entity->getMonth());
    }
}
