<?php

namespace Loevgaard\AltaPay\Entity;

use Loevgaard\AltaPay\Exception\XmlException;
use Money\Money;
use PHPUnit\Framework\TestCase;

final class TransactionTest extends TestCase
{
    public function testHydrate1()
    {
        $xml = <<<XML
<Transaction>
    <TransactionId>1</TransactionId>
    <PaymentId>ccc1479c-37f9-4962-8d2c-662d75117e9d</PaymentId>
    <AuthType>payment</AuthType>
    <CardStatus>Valid</CardStatus>
    <CreditCardToken>93f534a2f5d66d6ab3f16c8a7bb7e852656d4bb2</CreditCardToken>
    <CreditCardMaskedPan>411111******1111</CreditCardMaskedPan>
    <ThreeDSecureResult>Not_Applicable</ThreeDSecureResult>
    <LiableForChargeback>Merchant</LiableForChargeback>
    <CVVCheckResult>Not_Attempted</CVVCheckResult>
    <BlacklistToken>4f244dec4907eba0f6432e53b17a60ebcf51365e</BlacklistToken>
    <ShopOrderId>myorderid</ShopOrderId>
    <Shop>AltaPay Shop</Shop>
    <Terminal>AltaPay Test Terminal</Terminal>
    <TransactionStatus>captured</TransactionStatus>
    <ReasonCode>NONE</ReasonCode>
    <MerchantCurrency>978</MerchantCurrency>
    <MerchantCurrencyAlpha>EUR</MerchantCurrencyAlpha>
    <CardHolderCurrency>978</CardHolderCurrency>
    <CardHolderCurrencyAlpha>EUR</CardHolderCurrencyAlpha>
    <ReservedAmount>1.00</ReservedAmount>
    <CapturedAmount>1.00</CapturedAmount>
    <RefundedAmount>0</RefundedAmount>
    <CreditedAmount>10.00</CreditedAmount>
    <RecurringDefaultAmount>0</RecurringDefaultAmount>
    <SurchargeAmount>20.00</SurchargeAmount>
    <CreatedDate>2010-09-28 12:34:56</CreatedDate>
    <UpdatedDate>2010-09-28 12:34:56</UpdatedDate>
    <PaymentNature>CreditCard</PaymentNature>
    <PaymentNatureService name="TestAcquirer">
        <SupportsRefunds>true</SupportsRefunds>
        <SupportsRelease>true</SupportsRelease>
        <SupportsMultipleCaptures>true</SupportsMultipleCaptures>
        <SupportsMultipleRefunds>false</SupportsMultipleRefunds>
    </PaymentNatureService>
    <FraudRiskScore>13.37</FraudRiskScore>
    <FraudExplanation>Fraud detection explanation</FraudExplanation>
    <PaymentInfos>
        <PaymentInfo name="Form_Created_At">2010-09-28 12:34:56</PaymentInfo>
        <PaymentInfo name="Form_Provider">AltaPay Test Form</PaymentInfo>
        <PaymentInfo name="Merchant_Provided_Info">Some info by merchant</PaymentInfo>
    </PaymentInfos>
    <CustomerInfo>
        <UserAgent>Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.7 
        (KHTML, like Gecko) Chrome/16.0.912.41 Safari/535.7</UserAgent>
        <IpAddress>127.127.127.127</IpAddress>
        <Email>support@altapay.com</Email>
        <Username>support</Username>
        <CustomerPhone>+45 7020 0056</CustomerPhone>
        <OrganisationNumber>12345678</OrganisationNumber>
        <CountryOfOrigin>
        <Country>DK</Country>
        <Source>BillingAddress</Source>
        </CountryOfOrigin>
        <BillingAddress>
        <Firstname>Palle</Firstname>
        <Lastname>Simonsen</Lastname>
        <Address>Rosenkæret 13</Address>
        <City>Søborg</City>
        <PostalCode>2860</PostalCode>
        <Country>DK</Country>
        </BillingAddress>
        <ShippingAddress/>
        <RegisteredAddress/>
    </CustomerInfo>
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

        $entity = new Transaction();
        $entity->hydrateXml($xmlElement);

        $this->assertSame('payment', $entity->getAuthType());
        $this->assertSame('Not_Attempted', $entity->getCVVCheckResult());
        $this->assertEquals(new Money(1000, new \Money\Currency('EUR')), $entity->getCreditedAmount());
        $this->assertEquals(new Money(2000, new \Money\Currency('EUR')), $entity->getSurchargeAmount());
    }

    public function testHydrate2()
    {
        $xml = '<Transaction></Transaction>';
        $xmlElement = new \SimpleXMLElement($xml);

        $entity = new Transaction();
        $entity->hydrateXml($xmlElement);

        $this->assertSame(null, $entity->getAuthType());
        $this->assertSame(null, $entity->getCVVCheckResult());
        $this->assertSame(null, $entity->getCreditedAmount());
        $this->assertSame(null, $entity->getSurchargeAmount());
    }

    public function testHydrate3()
    {
        $xml = <<<XML
<Transaction>
    <CreatedDate>2010-09-28 invalid12:34:56</CreatedDate>
</Transaction>
XML;
        $xmlElement = new \SimpleXMLElement($xml);

        $this->expectException(XmlException::class);
        $entity = new Transaction();
        $entity->hydrateXml($xmlElement);
    }

    public function testHydrate4()
    {
        $xml = <<<XML
<Transaction>
    <UpdatedDate>2010-09-28 invalid1212:34:56</UpdatedDate>
</Transaction>
XML;
        $xmlElement = new \SimpleXMLElement($xml);

        $this->expectException(XmlException::class);
        $entity = new Transaction();
        $entity->hydrateXml($xmlElement);
    }
}
