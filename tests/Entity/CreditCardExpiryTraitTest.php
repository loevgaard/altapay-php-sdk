<?php

namespace Loevgaard\AltaPay\Entity;

use PHPUnit\Framework\TestCase;

final class CreditCardExpiryTraitTest extends TestCase
{
    public function testGetters()
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

        $mock = $this->getMockForTrait(CreditCardExpiryTrait::class);
        $mock->hydrateCreditCardExpiry($xmlElement);

        $this->assertInstanceOf(CreditCardExpiry::class, $mock->getCreditCardExpiry());
    }
}
