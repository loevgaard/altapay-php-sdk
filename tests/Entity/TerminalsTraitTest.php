<?php

namespace Loevgaard\AltaPay\Entity;

use PHPUnit\Framework\TestCase;

final class TerminalsTraitTest extends TestCase
{
    public function testHydrate1()
    {
        $xml = <<<XML
<Body>
    <Result>Success</Result>
    <Terminals>
        <Terminal>
            <Title>AltaPay Multi-Nature Terminal</Title>
            <Country>DK</Country>
            <Natures>
                <Nature>CreditCard</Nature>
                <Nature>EPayment</Nature>
                <Nature>IdealPayment</Nature>
                <Nature>Invoice</Nature>
            </Natures>
            <Currencies>
                <Currency>DKK</Currency>
                <Currency>EUR</Currency>
            </Currencies>
        </Terminal>
        <Terminal>
            <Title>AltaPay BankPayment Terminal</Title>
            <Natures>
                <Nature>BankPayment</Nature>
            </Natures>
            <Currencies>
                <Currency>EUR</Currency>
            </Currencies>
        </Terminal>
    </Terminals>
</Body>
XML;
        $xmlElement = new \SimpleXMLElement($xml);

        $mock = $this->getMockForTrait(TerminalsTrait::class);
        $mock->hydrateTerminals($xmlElement);

        $this->assertTrue(is_array($mock->getTerminals()));

        $terminal = $mock->getTerminals()[0];
        $this->assertInstanceOf(Terminal::class, $terminal);
    }

    public function testHydrate2()
    {
        $xml = '<Body></Body>';
        $xmlElement = new \SimpleXMLElement($xml);

        $mock = $this->getMockForTrait(TerminalsTrait::class);
        $mock->hydrateTerminals($xmlElement);

        $this->assertSame([], $mock->getTerminals());
    }

    public function testGettersSetters()
    {
        $terminals = [new Terminal()];

        $mock = $this->getMockForTrait(TerminalsTrait::class);
        $mock->setTerminals($terminals);

        $this->assertSame($terminals, $mock->getTerminals());
    }

    public function testAdd()
    {
        $terminal = new Terminal();

        $mock = $this->getMockForTrait(TerminalsTrait::class);
        $mock->addTerminal($terminal);

        $this->assertSame([$terminal], $mock->getTerminals());
    }
}
