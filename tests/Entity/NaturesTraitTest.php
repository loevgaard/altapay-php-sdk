<?php

namespace Loevgaard\AltaPay\Entity;

use PHPUnit\Framework\TestCase;

final class NaturesTraitTest extends TestCase
{
    public function testHydrate1()
    {
        $xml = <<<XML
<Terminal>
    <Natures>
        <Nature>CreditCard</Nature>
        <Nature>EPayment</Nature>
        <Nature>IdealPayment</Nature>
        <Nature>Invoice</Nature>
    </Natures>
</Terminal>
XML;
        $xmlElement = new \SimpleXMLElement($xml);

        $mock = $this->getMockForTrait(NaturesTrait::class);
        $mock->hydrateNatures($xmlElement);

        $this->assertTrue(is_array($mock->getNatures()));

        $nature = $mock->getNatures()[0];
        $this->assertInstanceOf(Nature::class, $nature);
    }

    public function testHydrate2()
    {
        $xml = '<Terminal></Terminal>';
        $xmlElement = new \SimpleXMLElement($xml);

        $mock = $this->getMockForTrait(NaturesTrait::class);
        $mock->hydrateNatures($xmlElement);

        $this->assertSame([], $mock->getNatures());
    }

    public function testGettersSetters()
    {
        $natures = [new Nature()];

        $mock = $this->getMockForTrait(NaturesTrait::class);
        $mock->setNatures($natures);

        $this->assertSame($natures, $mock->getNatures());
    }

    public function testAdd()
    {
        $nature = new Nature();

        $mock = $this->getMockForTrait(NaturesTrait::class);
        $mock->addNature($nature);

        $this->assertSame([$nature], $mock->getNatures());
    }
}
