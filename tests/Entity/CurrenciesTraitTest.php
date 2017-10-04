<?php

namespace Loevgaard\AltaPay\Entity;

use PHPUnit\Framework\TestCase;

final class CurrenciesTraitTest extends TestCase
{
    public function testHydrate1()
    {
        $xml = <<<XML
<Terminal>
    <Currencies>
        <Currency>DKK</Currency>
        <Currency>EUR</Currency>
    </Currencies>
</Terminal>
XML;
        $xmlElement = new \SimpleXMLElement($xml);

        $mock = $this->getMockForTrait(CurrenciesTrait::class);
        $mock->hydrateCurrencies($xmlElement);

        $this->assertTrue(is_array($mock->getCurrencies()));

        $currency = $mock->getCurrencies()[0];
        $this->assertInstanceOf(Currency::class, $currency);
    }

    public function testHydrate2()
    {
        $xml = '<Terminal></Terminal>';
        $xmlElement = new \SimpleXMLElement($xml);

        $mock = $this->getMockForTrait(CurrenciesTrait::class);
        $mock->hydrateCurrencies($xmlElement);

        $this->assertSame([], $mock->getCurrencies());
    }

    public function testGettersSetters()
    {
        $currencies = [new Currency()];

        $mock = $this->getMockForTrait(CurrenciesTrait::class);
        $mock->setCurrencies($currencies);

        $this->assertSame($currencies, $mock->getCurrencies());
    }

    public function testAdd()
    {
        $currency = new Currency();

        $mock = $this->getMockForTrait(CurrenciesTrait::class);
        $mock->addCurrency($currency);

        $this->assertSame([$currency], $mock->getCurrencies());
    }
}
