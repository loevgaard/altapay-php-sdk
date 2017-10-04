<?php

namespace Loevgaard\AltaPay\Entity;

use PHPUnit\Framework\TestCase;

final class PaymentInfosTraitTest extends TestCase
{
    public function testHydrate1()
    {
        $xml = <<<XML
<Transaction>
    <PaymentInfos>
        <PaymentInfo name="Form_Created_At">2010-09-28 12:34:56</PaymentInfo>
        <PaymentInfo name="Form_Provider">AltaPay Test Form</PaymentInfo>
        <PaymentInfo name="Merchant_Provided_Info">Some info by merchant</PaymentInfo>
    </PaymentInfos>
</Transaction>
XML;
        $xmlElement = new \SimpleXMLElement($xml);

        $mock = $this->getMockForTrait(PaymentInfosTrait::class);
        $mock->hydratePaymentInfos($xmlElement);

        $this->assertTrue(is_array($mock->getPaymentInfos()));

        $paymentInfo = $mock->getPaymentInfos()[0];
        $this->assertInstanceOf(PaymentInfo::class, $paymentInfo);
    }

    public function testHydrate2()
    {
        $xml = '<Transaction></Transaction>';
        $xmlElement = new \SimpleXMLElement($xml);

        $mock = $this->getMockForTrait(PaymentInfosTrait::class);
        $mock->hydratePaymentInfos($xmlElement);

        $this->assertSame([], $mock->getPaymentInfos());
    }

    public function testGettersSetters()
    {
        $paymentInfos = [new PaymentInfo()];

        $mock = $this->getMockForTrait(PaymentInfosTrait::class);
        $mock->setPaymentInfos($paymentInfos);

        $this->assertSame($paymentInfos, $mock->getPaymentInfos());
    }

    public function testAdd()
    {
        $paymentInfo = new PaymentInfo();

        $mock = $this->getMockForTrait(PaymentInfosTrait::class);
        $mock->addPaymentInfo($paymentInfo);

        $this->assertSame([$paymentInfo], $mock->getPaymentInfos());
    }
}
