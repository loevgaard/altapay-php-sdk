<?php

namespace Loevgaard\AltaPay\Response;

use Loevgaard\AltaPay\Entity\BillingAddress;
use Loevgaard\AltaPay\Entity\CountryOfOrigin;
use Loevgaard\AltaPay\Entity\CustomerInfo;
use Loevgaard\AltaPay\Entity\PaymentInfo;
use Loevgaard\AltaPay\Entity\PaymentNatureService;
use Loevgaard\AltaPay\Entity\ReconciliationIdentifier;
use Loevgaard\AltaPay\Entity\Transaction;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

final class CaptureReservationTest extends TestCase
{
    public function testGetters()
    {
        // this xml is taken from the example found here:
        // https://testgateway.altapaysecure.com/merchant/help/Merchant_API#API_captureReservation
        $xml = file_get_contents(__DIR__.'/../data/CaptureReservationResponse.xml');

        $response = new \GuzzleHttp\Psr7\Response(200, [], $xml);
        $captureReservationResponse = new CaptureReservation($response);

        $this->assertInstanceOf(PsrResponseInterface::class, $captureReservationResponse->getResponse());

        $this->assertSame(0.2, $captureReservationResponse->getCaptureAmount());
        $this->assertSame(978, $captureReservationResponse->getCaptureCurrency());
        $this->assertSame('Success', $captureReservationResponse->getResult());
        $this->assertSame('Success', $captureReservationResponse->getCaptureResult());
        $this->assertTrue(is_array($captureReservationResponse->getTransactions()));
        $this->assertSame(1, count($captureReservationResponse->getTransactions()));

        /**
         * testing a single transaction object
         */
        $transactionResponse = $captureReservationResponse->getTransactions()[0];
        $this->assertInstanceOf(Transaction::class, $transactionResponse);

        $this->assertTrue(is_int($transactionResponse->getTransactionId()));
        $this->assertSame(1, $transactionResponse->getTransactionId());
        $this->assertSame('ccc1479c-37f9-4962-8d2c-662d75117e9d', $transactionResponse->getPaymentId());
        $this->assertSame('Valid', $transactionResponse->getCardStatus());
        $this->assertSame('93f534a2f5d66d6ab3f16c8a7bb7e852656d4bb2', $transactionResponse->getCreditCardToken());
        $this->assertSame('411111******1111', $transactionResponse->getCreditCardMaskedPan());
        $this->assertSame('Not_Applicable', $transactionResponse->getThreeDSecureResult());
        $this->assertSame('Merchant', $transactionResponse->getLiableForChargeback());
        $this->assertSame('4f244dec4907eba0f6432e53b17a60ebcf51365e', $transactionResponse->getBlacklistToken());
        $this->assertSame('myorderid', $transactionResponse->getShopOrderId());
        $this->assertSame('AltaPay Shop', $transactionResponse->getShop());
        $this->assertSame('AltaPay Test Terminal', $transactionResponse->getTerminal());
        $this->assertSame('captured', $transactionResponse->getTransactionStatus());
        $this->assertSame('NONE', $transactionResponse->getReasonCode());
        $this->assertSame(978, $transactionResponse->getMerchantCurrency());
        $this->assertSame('EUR', $transactionResponse->getMerchantCurrencyAlpha());
        $this->assertSame(978, $transactionResponse->getCardHolderCurrency());
        $this->assertSame('EUR', $transactionResponse->getCardHolderCurrencyAlpha());
        $this->assertSame(1.00, $transactionResponse->getReservedAmount());
        $this->assertSame(1.00, $transactionResponse->getCapturedAmount());
        $this->assertSame(0.0, $transactionResponse->getRefundedAmount());
        $this->assertSame(0.0, $transactionResponse->getRecurringDefaultAmount());
        $this->assertInstanceOf('\DateTimeImmutable', $transactionResponse->getCreatedDate());
        $this->assertSame('2010-09-28 12:34:56', $transactionResponse->getCreatedDate()->format('Y-m-d H:i:s'));
        $this->assertInstanceOf('\DateTimeImmutable', $transactionResponse->getUpdatedDate());
        $this->assertSame('2010-09-28 12:34:57', $transactionResponse->getUpdatedDate()->format('Y-m-d H:i:s'));
        $this->assertSame('CreditCard', $transactionResponse->getPaymentNature());
        $this->assertSame(13.37, $transactionResponse->getFraudRiskScore());
        $this->assertSame('Fraud detection explanation', $transactionResponse->getFraudExplanation());

        // test payment nature
        $this->assertInstanceOf(PaymentNatureService::class, $transactionResponse->getPaymentNatureService());
        $this->assertTrue(is_string($transactionResponse->getPaymentNatureService()->getName()));
        $this->assertTrue($transactionResponse->getPaymentNatureService()->isSupportsRefunds());

        $this->assertTrue($transactionResponse->getPaymentNatureService()->isSupportsRelease());

        $this->assertTrue($transactionResponse->getPaymentNatureService()->isSupportsMultipleCaptures());

        $this->assertFalse($transactionResponse->getPaymentNatureService()->isSupportsMultipleRefunds());

        // test payment infos
        $this->assertTrue(is_array($transactionResponse->getPaymentInfos()));
        $paymentInfoResponse = $transactionResponse->getPaymentInfos()[0];
        $this->assertInstanceOf(PaymentInfo::class, $paymentInfoResponse);
        $this->assertSame('Form_Created_At', $paymentInfoResponse->getName());
        $this->assertSame('2010-09-28 12:34:56', $paymentInfoResponse->getValue());

        // test customer info
        $this->assertInstanceOf(CustomerInfo::class, $transactionResponse->getCustomerInfo());
        $this->assertSame(
            'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.41 Safari/535.7',
            $transactionResponse->getCustomerInfo()->getUserAgent()
        );
        $this->assertSame('127.127.127.127', $transactionResponse->getCustomerInfo()->getIpAddress());
        $this->assertSame('support@altapay.com', $transactionResponse->getCustomerInfo()->getEmail());
        $this->assertSame('support', $transactionResponse->getCustomerInfo()->getUsername());
        $this->assertSame('+45 7020 0056', $transactionResponse->getCustomerInfo()->getCustomerPhone());
        $this->assertSame('12345678', $transactionResponse->getCustomerInfo()->getOrganisationNumber());

        $this->assertInstanceOf(
            CountryOfOrigin::class,
            $transactionResponse->getCustomerInfo()->getCountryOfOrigin()
        );
        $this->assertSame('DK', $transactionResponse->getCustomerInfo()->getCountryOfOrigin()->getCountry());
        $this->assertSame(
            'BillingAddress',
            $transactionResponse->getCustomerInfo()->getCountryOfOrigin()->getSource()
        );

        $this->assertInstanceOf(
            BillingAddress::class,
            $transactionResponse->getCustomerInfo()->getBillingAddress()
        );
        $this->assertSame('Palle', $transactionResponse->getCustomerInfo()->getBillingAddress()->getFirstName());
        $this->assertSame('Simonsen', $transactionResponse->getCustomerInfo()->getBillingAddress()->getLastName());
        $this->assertSame(
            'Rosenkæret 13',
            $transactionResponse->getCustomerInfo()->getBillingAddress()->getAddress()
        );
        $this->assertSame('Søborg', $transactionResponse->getCustomerInfo()->getBillingAddress()->getCity());
        $this->assertSame('2860', $transactionResponse->getCustomerInfo()->getBillingAddress()->getPostalCode());
        $this->assertSame('DK', $transactionResponse->getCustomerInfo()->getBillingAddress()->getCountry());

        // test reconciliation identifiers
        $this->assertTrue(is_array($transactionResponse->getReconciliationIdentifiers()));
        $this->assertSame(1, count($transactionResponse->getReconciliationIdentifiers()));
        $reconciliationIdentifier = $transactionResponse->getReconciliationIdentifiers()[0];
        $this->assertInstanceOf(ReconciliationIdentifier::class, $reconciliationIdentifier);
        $this->assertSame('f4e2533e-c578-4383-b075-bc8a6866784a', $reconciliationIdentifier->getId());
        $this->assertSame(1.00, $reconciliationIdentifier->getAmount());
        $this->assertSame(978, $reconciliationIdentifier->getAmountCurrency());
        $this->assertSame('captured', $reconciliationIdentifier->getType());
        $this->assertInstanceOf('\DateTimeImmutable', $reconciliationIdentifier->getDate());
        $this->assertSame('2010-09-28T12:00:00+02:00', $reconciliationIdentifier->getDate()->format(DATE_RFC3339));
    }
}
