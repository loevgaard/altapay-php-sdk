<?php

namespace Loevgaard\AltaPay\Entity;

use PHPUnit\Framework\TestCase;

final class TransactionsTraitTest extends TestCase
{
    public function testHydrate1()
    {
        $xml = <<<XML
<Body>
    <Transactions>
        <Transaction>
            <TransactionId>1</TransactionId>
            <PaymentId>ccc1479c-37f9-4962-8d2c-662d75117e9d</PaymentId>
            <CardStatus>Valid</CardStatus>
            <CreditCardToken>93f534a2f5d66d6ab3f16c8a7bb7e852656d4bb2</CreditCardToken>
            <CreditCardMaskedPan>411111******1111</CreditCardMaskedPan>
            <ThreeDSecureResult>Not_Applicable</ThreeDSecureResult>
            <LiableForChargeback>Merchant</LiableForChargeback>
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
            <RecurringDefaultAmount>0</RecurringDefaultAmount>
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
    </Transactions>
    </Body>
XML;
        $xmlElement = new \SimpleXMLElement($xml);

        $mock = $this->getMockForTrait(TransactionsTrait::class);
        $mock->hydrateTransactions($xmlElement);

        $this->assertTrue(is_array($mock->getTransactions()));

        $transaction = $mock->getTransactions()[0];
        $this->assertInstanceOf(Transaction::class, $transaction);
    }

    public function testHydrate2()
    {
        $xml = '<Body></Body>';
        $xmlElement = new \SimpleXMLElement($xml);

        $mock = $this->getMockForTrait(TransactionsTrait::class);
        $mock->hydrateTransactions($xmlElement);

        $this->assertSame([], $mock->getTransactions());
    }

    public function testGettersSetters()
    {
        $transactions = [new Transaction()];

        $mock = $this->getMockForTrait(TransactionsTrait::class);
        $mock->setTransactions($transactions);

        $this->assertSame($transactions, $mock->getTransactions());
    }

    public function testAdd()
    {
        $transaction = new Transaction();

        $mock = $this->getMockForTrait(TransactionsTrait::class);
        $mock->addTerminal($transaction);

        $this->assertSame([$transaction], $mock->getTransactions());
    }
}
