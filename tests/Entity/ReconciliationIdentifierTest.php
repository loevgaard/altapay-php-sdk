<?php

namespace Loevgaard\AltaPay\Entity;

use Loevgaard\AltaPay\Exception\XmlException;
use PHPUnit\Framework\TestCase;

final class ReconciliationIdentifierTest extends TestCase
{
    public function testHydrate1()
    {
        $xml = <<<XML
<ReconciliationIdentifier>
    <Id>f4e2533e-c578-4383-b075-bc8a6866784a</Id>
    <Amount currency="978">1.00</Amount>
    <Type>captured</Type>
    <Date>2010-09-28T12:00:00+02:00</Date>
</ReconciliationIdentifier>
XML;
        $xmlElement = new \SimpleXMLElement($xml);

        $entity = new ReconciliationIdentifier();
        $entity->hydrateXml($xmlElement);

        $this->assertSame('f4e2533e-c578-4383-b075-bc8a6866784a', $entity->getId());
        $this->assertSame(1.0, $entity->getAmount());
        $this->assertSame('captured', $entity->getType());
        $this->assertInstanceOf(\DateTimeImmutable::class, $entity->getDate());
        $this->assertSame('2010-09-28T12:00:00+02:00', $entity->getDate()->format(DATE_RFC3339));
    }

    public function testHydrate2()
    {
        $xml = <<<XML
<ReconciliationIdentifier>
    <Id>f4e2533e-c578-4383-b075-bc8a6866784a</Id>
    <Amount currency="978">1.00</Amount>
    <Type>captured</Type>
    <Date>2010-09-28T12:00:0invalid0+02:00</Date>
</ReconciliationIdentifier>
XML;

        $this->expectException(XmlException::class);
        $xmlElement = new \SimpleXMLElement($xml);

        $entity = new ReconciliationIdentifier();
        $entity->hydrateXml($xmlElement);
    }
}
