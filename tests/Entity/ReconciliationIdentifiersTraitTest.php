<?php

namespace Loevgaard\AltaPay\Entity;

use PHPUnit\Framework\TestCase;

final class ReconciliationIdentifiersTraitTest extends TestCase
{
    public function testHydrate1()
    {
        $xml = <<<XML
<Transaction>
    <ReconciliationIdentifiers>
        <ReconciliationIdentifier>
            <Id>f4e2533e-c578-4383-b075-bc8a6866784a</Id>
            <Amount currency="978">1.00</Amount>
            <Type>captured</Type>
            <Date>2010-09-28T12:00:00+02:00</Date>
        </ReconciliationIdentifier>
    </ReconciliationIdentifiers>
</Transaction>
XML;
        $xmlElement = new \SimpleXMLElement($xml);

        $mock = $this->getMockForTrait(ReconciliationIdentifiersTrait::class);
        $mock->hydrateReconciliationIdentifiers($xmlElement);

        $this->assertTrue(is_array($mock->getReconciliationIdentifiers()));

        $reconciliationIdentifier = $mock->getReconciliationIdentifiers()[0];
        $this->assertInstanceOf(ReconciliationIdentifier::class, $reconciliationIdentifier);
    }

    public function testHydrate2()
    {
        $xml = '<Transaction></Transaction>';
        $xmlElement = new \SimpleXMLElement($xml);

        $mock = $this->getMockForTrait(ReconciliationIdentifiersTrait::class);
        $mock->hydrateReconciliationIdentifiers($xmlElement);

        $this->assertSame([], $mock->getReconciliationIdentifiers());
    }

    public function testGettersSetters()
    {
        $reconciliationIdentifiers = [new ReconciliationIdentifier()];

        $mock = $this->getMockForTrait(ReconciliationIdentifiersTrait::class);
        $mock->setReconciliationIdentifiers($reconciliationIdentifiers);

        $this->assertSame($reconciliationIdentifiers, $mock->getReconciliationIdentifiers());
    }

    public function testAdd()
    {
        $reconciliationIdentifier = new ReconciliationIdentifier();

        $mock = $this->getMockForTrait(ReconciliationIdentifiersTrait::class);
        $mock->addReconciliationIdentifier($reconciliationIdentifier);

        $this->assertSame([$reconciliationIdentifier], $mock->getReconciliationIdentifiers());
    }
}
