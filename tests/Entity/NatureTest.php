<?php

namespace Loevgaard\AltaPay\Entity;

use PHPUnit\Framework\TestCase;

final class NatureTest extends TestCase
{
    public function testHydrate()
    {
        $xml = '<Nature>CreditCard</Nature>';
        $xmlElement = new \SimpleXMLElement($xml);

        $entity = new Nature();
        $entity->hydrateXml($xmlElement);

        $this->assertSame('CreditCard', $entity->getNature());
    }

    public function testToString()
    {
        $xml = '<Nature>CreditCard</Nature>';
        $xmlElement = new \SimpleXMLElement($xml);

        $entity = new Nature();
        $entity->hydrateXml($xmlElement);

        $this->assertSame('CreditCard', (string)$entity);
    }
}
