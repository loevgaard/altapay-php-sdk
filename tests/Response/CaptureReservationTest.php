<?php

namespace Loevgaard\AltaPay\Response;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

final class CaptureReservationTest extends TestCase
{
    public function testGetters()
    {
        // this xml is taken from the example found here: https://testgateway.altapaysecure.com/merchant/help/Merchant_API#API_captureReservation
        $xml = <<<XML
<APIResponse version="20170228">
   <Header>
      <Date>2010-09-29T12:34:56+02:00</Date>
      <Path>API/captureReservation</Path>
      <ErrorCode>0</ErrorCode>
      <ErrorMessage></ErrorMessage>
   </Header>
   <Body>
      <CaptureAmount>0.20</CaptureAmount>
      <CaptureCurrency>978</CaptureCurrency>
      <Result>Success</Result>
      <CaptureResult>Success</CaptureResult> <!-- deprecated -->
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
            <UpdatedDate>2010-09-28 12:34:57</UpdatedDate>
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
               <UserAgent>Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.41 Safari/535.7</UserAgent>
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
               <ShippingAddress />
               <RegisteredAddress />
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
</APIResponse>
XML;

        $response = new \GuzzleHttp\Psr7\Response(200, [], $xml);
        $captureReservationResponse = new CaptureReservation($response);

        $this->assertInstanceOf(PsrResponseInterface::class, $captureReservationResponse->getResponse());

        $this->assertTrue(is_float($captureReservationResponse->getCaptureAmount()));
        $this->assertEquals(0.2, $captureReservationResponse->getCaptureAmount());
        $this->assertTrue(is_int($captureReservationResponse->getCaptureCurrency()));
        $this->assertEquals(978, $captureReservationResponse->getCaptureCurrency());
        $this->assertTrue(is_string($captureReservationResponse->getResult()));
        $this->assertEquals('Success', $captureReservationResponse->getResult());
        $this->assertTrue(is_string($captureReservationResponse->getCaptureResult()));
        $this->assertEquals('Success', $captureReservationResponse->getCaptureResult());
        $this->assertTrue(is_array($captureReservationResponse->getTransactions()));
        $this->assertTrue(!empty($captureReservationResponse->getTransactions()));
        $this->assertEquals(1, count($captureReservationResponse->getTransactions()));

        /**
         * testing a single transaction object
         */
        $transactionResponse = $captureReservationResponse->getTransactions()[0];
        $this->assertInstanceOf('Loevgaard\AltaPay\Response\CaptureReservation\Transaction', $transactionResponse);
        $this->assertEquals($captureReservationResponse->getResponse(), $transactionResponse->getOriginalResponse());

        $this->assertTrue(is_int($transactionResponse->getTransactionId()));
        $this->assertEquals(1, $transactionResponse->getTransactionId());
        $this->assertEquals('ccc1479c-37f9-4962-8d2c-662d75117e9d', $transactionResponse->getPaymentId());
        $this->assertEquals('Valid', $transactionResponse->getCardStatus());
        $this->assertEquals('93f534a2f5d66d6ab3f16c8a7bb7e852656d4bb2', $transactionResponse->getCreditCardToken());
        $this->assertEquals('411111******1111', $transactionResponse->getCreditCardMaskedPan());
        $this->assertEquals('Not_Applicable', $transactionResponse->getThreeDSecureResult());
        $this->assertEquals('Merchant', $transactionResponse->getLiableForChargeback());
        $this->assertEquals('4f244dec4907eba0f6432e53b17a60ebcf51365e', $transactionResponse->getBlacklistToken());
        $this->assertEquals('myorderid', $transactionResponse->getShopOrderId());
        $this->assertEquals('AltaPay Shop', $transactionResponse->getShop());
        $this->assertEquals('AltaPay Test Terminal', $transactionResponse->getTerminal());
        $this->assertEquals('captured', $transactionResponse->getTransactionStatus());
        $this->assertEquals('NONE', $transactionResponse->getReasonCode());
        $this->assertTrue(is_int($transactionResponse->getMerchantCurrency()));
        $this->assertEquals(978, $transactionResponse->getMerchantCurrency());
        $this->assertEquals('EUR', $transactionResponse->getMerchantCurrencyAlpha());
        $this->assertTrue(is_int($transactionResponse->getCardHolderCurrency()));
        $this->assertEquals(978, $transactionResponse->getCardHolderCurrency());
        $this->assertEquals('EUR', $transactionResponse->getCardHolderCurrencyAlpha());
        $this->assertTrue(is_float($transactionResponse->getReservedAmount()));
        $this->assertEquals(1.00, $transactionResponse->getReservedAmount());
        $this->assertTrue(is_float($transactionResponse->getCapturedAmount()));
        $this->assertEquals(1.00, $transactionResponse->getCapturedAmount());
        $this->assertTrue(is_float($transactionResponse->getRefundedAmount()));
        $this->assertEquals(0, $transactionResponse->getRefundedAmount());
        $this->assertTrue(is_float($transactionResponse->getRecurringDefaultAmount()));
        $this->assertEquals(0, $transactionResponse->getRecurringDefaultAmount());
        $this->assertInstanceOf('\DateTimeImmutable', $transactionResponse->getCreatedDate());
        $this->assertEquals('2010-09-28 12:34:56', $transactionResponse->getCreatedDate()->format('Y-m-d H:i:s'));
        $this->assertInstanceOf('\DateTimeImmutable', $transactionResponse->getUpdatedDate());
        $this->assertEquals('2010-09-28 12:34:57', $transactionResponse->getUpdatedDate()->format('Y-m-d H:i:s'));
        $this->assertEquals('CreditCard', $transactionResponse->getPaymentNature());
        $this->assertTrue(is_float($transactionResponse->getFraudRiskScore()));
        $this->assertEquals(13.37, $transactionResponse->getFraudRiskScore());
        $this->assertEquals('Fraud detection explanation', $transactionResponse->getFraudExplanation());

        // test payment nature
        $this->assertInstanceOf('Loevgaard\AltaPay\Response\CaptureReservation\Transaction\PaymentNatureService', $transactionResponse->getPaymentNatureService());
        $this->assertEquals($captureReservationResponse->getResponse(), $transactionResponse->getPaymentNatureService()->getOriginalResponse());
        $this->assertTrue(is_string($transactionResponse->getPaymentNatureService()->getName()));
        $this->assertTrue(is_bool($transactionResponse->getPaymentNatureService()->getSupportsRefunds()));
        $this->assertTrue($transactionResponse->getPaymentNatureService()->getSupportsRefunds());

        $this->assertTrue(is_bool($transactionResponse->getPaymentNatureService()->getSupportsRelease()));
        $this->assertTrue($transactionResponse->getPaymentNatureService()->getSupportsRelease());

        $this->assertTrue(is_bool($transactionResponse->getPaymentNatureService()->getSupportsMultipleCaptures()));
        $this->assertTrue($transactionResponse->getPaymentNatureService()->getSupportsMultipleCaptures());

        $this->assertTrue(is_bool($transactionResponse->getPaymentNatureService()->getSupportsMultipleRefunds()));
        $this->assertFalse($transactionResponse->getPaymentNatureService()->getSupportsMultipleRefunds());

        // test payment infos
        $this->assertTrue(is_array($transactionResponse->getPaymentInfos()));
        $paymentInfoResponse = $transactionResponse->getPaymentInfos()[0];
        $this->assertInstanceOf('Loevgaard\AltaPay\Response\CaptureReservation\Transaction\PaymentInfo', $paymentInfoResponse);
        $this->assertEquals('Form_Created_At', $paymentInfoResponse->getName());
        $this->assertEquals('2010-09-28 12:34:56', $paymentInfoResponse->getValue());

        // test customer info
        $this->assertInstanceOf('Loevgaard\AltaPay\Response\CaptureReservation\Transaction\CustomerInfo', $transactionResponse->getCustomerInfo());
        $this->assertEquals('Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.41 Safari/535.7', $transactionResponse->getCustomerInfo()->getUserAgent());
        $this->assertEquals('127.127.127.127', $transactionResponse->getCustomerInfo()->getIpAddress());
        $this->assertEquals('support@altapay.com', $transactionResponse->getCustomerInfo()->getEmail());
        $this->assertEquals('support', $transactionResponse->getCustomerInfo()->getUsername());
        $this->assertEquals('+45 7020 0056', $transactionResponse->getCustomerInfo()->getCustomerPhone());
        $this->assertEquals('12345678', $transactionResponse->getCustomerInfo()->getOrganisationNumber());

        $this->assertInstanceOf('Loevgaard\AltaPay\Response\CaptureReservation\Transaction\CustomerInfo\CountryOfOrigin', $transactionResponse->getCustomerInfo()->getCountryOfOrigin());
        $this->assertEquals('DK', $transactionResponse->getCustomerInfo()->getCountryOfOrigin()->getCountry());
        $this->assertEquals('BillingAddress', $transactionResponse->getCustomerInfo()->getCountryOfOrigin()->getSource());

        $this->assertInstanceOf('Loevgaard\AltaPay\Response\CaptureReservation\Transaction\CustomerInfo\BillingAddress', $transactionResponse->getCustomerInfo()->getBillingAddress());
        $this->assertEquals('Palle', $transactionResponse->getCustomerInfo()->getBillingAddress()->getFirstName());
        $this->assertEquals('Simonsen', $transactionResponse->getCustomerInfo()->getBillingAddress()->getLastName());
        $this->assertEquals('Rosenkæret 13', $transactionResponse->getCustomerInfo()->getBillingAddress()->getAddress());
        $this->assertEquals('Søborg', $transactionResponse->getCustomerInfo()->getBillingAddress()->getCity());
        $this->assertEquals('2860', $transactionResponse->getCustomerInfo()->getBillingAddress()->getPostalCode());
        $this->assertEquals('DK', $transactionResponse->getCustomerInfo()->getBillingAddress()->getCountry());

        // test reconciliation identifiers
        $this->assertTrue(is_array($transactionResponse->getReconciliationIdentifiers()));
        $this->assertEquals(1, count($transactionResponse->getReconciliationIdentifiers()));
        $reconciliationIdentifier = $transactionResponse->getReconciliationIdentifiers()[0];
        $this->assertInstanceOf('Loevgaard\AltaPay\Response\CaptureReservation\Transaction\ReconciliationIdentifier', $reconciliationIdentifier);
        $this->assertEquals('f4e2533e-c578-4383-b075-bc8a6866784a', $reconciliationIdentifier->getId());
        $this->assertTrue(is_float($reconciliationIdentifier->getAmount()));
        $this->assertEquals(1.00, $reconciliationIdentifier->getAmount());
        $this->assertTrue(is_int($reconciliationIdentifier->getAmountCurrency()));
        $this->assertEquals(978, $reconciliationIdentifier->getAmountCurrency());
        $this->assertEquals('captured', $reconciliationIdentifier->getType());
        $this->assertInstanceOf('\DateTimeImmutable', $reconciliationIdentifier->getDate());
        $this->assertEquals('2010-09-28T12:00:00+02:00', $reconciliationIdentifier->getDate()->format(DATE_RFC3339));
    }
}
