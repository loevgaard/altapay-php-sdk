<?php

namespace Loevgaard\AltaPay\Entity;

use PHPUnit\Framework\TestCase;

final class CurrencyTest extends TestCase
{
    public function testHydrate()
    {
        $xml = <<<XML
<Currency>EUR</Currency>
XML;
        $xmlElement = new \SimpleXMLElement($xml);

        $entity = new Currency();
        $entity->hydrateXml($xmlElement);

        $this->assertSame('EUR', $entity->getCurrency());
    }

    public function testToString()
    {
        $xml = '<Currency>EUR</Currency>';
        $xmlElement = new \SimpleXMLElement($xml);

        $entity = new Currency();
        $entity->hydrateXml($xmlElement);

        $this->assertSame('EUR', (string)$entity);
    }
}
