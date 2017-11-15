<?php

namespace Loevgaard\AltaPay\Payload;

use Loevgaard\AltaPay;
use Loevgaard\AltaPay\Payload\PaymentRequest as PaymentRequestPayload;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;

final class PaymentRequestTest extends TestCase
{
    public function testGettersSetters()
    {
        $customerCreatedDate = \DateTime::createFromFormat('Y-m-d', '2017-05-31');

        $amount = new Money(25095, new Currency('DKK'));
        $salesTax = new Money(10000, new Currency('DKK'));

        $paymentRequest = new PaymentRequest('terminal', 'orderid', $amount);
        $paymentRequest->setSalesTax($salesTax)
            ->setType('type')
            ->setLanguage('da')
            ->setShippingMethod('shippingmethod')
            ->setCookiePart('key', 'val')
            ->setTransactionInfo(['transactioninfo'])
            ->setCcToken('cctoken')
            ->setSaleReconciliationIdentifier('saleReconciliationIdentifier')
            ->setSaleInvoiceNumber('invoicenumber')
            ->setPaymentSource('paymentsource')
            ->setFraudService('fraudservice')
            ->setCustomerCreatedDate($customerCreatedDate)
            ->setOrganisationNumber('organisationnumber')
            ->setAccountOffer('accountoffer')
        ;

        $this->assertSame('terminal', $paymentRequest->getTerminal());
        $this->assertSame('orderid', $paymentRequest->getShopOrderId());
        $this->assertEquals($amount, $paymentRequest->getAmount());
        $this->assertEquals($salesTax, $paymentRequest->getSalesTax());
        $this->assertSame('type', $paymentRequest->getType());
        $this->assertSame('da', $paymentRequest->getLanguage());
        $this->assertSame('shippingmethod', $paymentRequest->getShippingMethod());
        $this->assertSame('val', $paymentRequest->getCookiePart('key'));
        $this->assertSame(['transactioninfo'], $paymentRequest->getTransactionInfo());
        $this->assertSame('cctoken', $paymentRequest->getCcToken());
        $this->assertSame('saleReconciliationIdentifier', $paymentRequest->getSaleReconciliationIdentifier());
        $this->assertSame('invoicenumber', $paymentRequest->getSaleInvoiceNumber());
        $this->assertSame('paymentsource', $paymentRequest->getPaymentSource());
        $this->assertSame('fraudservice', $paymentRequest->getFraudService());
        $this->assertSame($customerCreatedDate, $paymentRequest->getCustomerCreatedDate());
        $this->assertSame('organisationnumber', $paymentRequest->getOrganisationNumber());
        $this->assertSame('accountoffer', $paymentRequest->getAccountOffer());
    }

    public function testGettersSetters2()
    {
        $amount = new Money(15095, new Currency('EUR'));
        $paymentRequest = new PaymentRequest('terminal', 'orderid', $amount);

        $paymentRequest->setTerminal('terminal2')
            ->setShopOrderId('orderid2')
            ->setCookieParts(['cookiesparts'])
        ;

        $this->assertSame('terminal2', $paymentRequest->getTerminal());
        $this->assertSame('orderid2', $paymentRequest->getShopOrderId());
        $this->assertEquals($amount, $paymentRequest->getAmount());
        $this->assertSame(['cookiesparts'], $paymentRequest->getCookieParts());
    }

    public function testGetPayload()
    {
        $birthDate = \DateTime::createFromFormat('Y-m-d', '1972-05-22');
        $customerCreatedDate = \DateTime::createFromFormat('Y-m-d', '2017-05-31');
        $expected = [
            'shop_orderid' => (string)time(),
            'amount' => 100.50,
            'currency' => 'DKK',
            'terminal' => 'terminal',
            'account_offer' => 'account offer',
            'ccToken' => 'cc token',
            'language' => 'da',
            'cookie' => 'somecookie=cookievalue',
            'customer_created_date' => $customerCreatedDate->format('Y-m-d'),
            'fraud_service' => 'fraud service',
            'organisation_number' => 'DK123123123',
            'payment_source' => PaymentRequest::PAYMENT_SOURCE_ECOMMERCE,
            'sale_invoice_number' => 'INV2020202',
            'sale_reconciliation_identifier' => 'IDNT98721',
            'sales_tax' => 20.50,
            'shipping_method' => 'PostNord',
            'type' => 'type',
            'config' => [
                'callback_form' => 'http://shopdomain.url/pensiopayment/form.php',
                'callback_ok' => 'http://shopdomain.url/pensiopayment/ok.php',
                'callback_fail' => 'http://shopdomain.url/pensiopayment/fail.php',
                'callback_redirect' => 'http://shopdomain.url/pensiopayment/redirect.php',
                'callback_open' => 'http://shopdomain.url/pensiopayment/open.php',
                'callback_notification' => 'http://shopdomain.url/pensiopayment/notification.php',
                'callback_verify_order' => 'http://shopdomain.url/pensiopayment/verify_order.php',
            ],
            'customer_info' => [
                'bank_name' => 'Spar Nord',
                'bank_phone' => '98888888',
                'billing_address' => 'Syrenvej 31',
                'billing_city' => 'Aalborg',
                'billing_country' => 'DK',
                'billing_firstname' => 'Emil',
                'billing_lastname' => 'Jensen',
                'billing_postal' => '9000',
                'billing_region' => 'Region Nord',
                'birthdate' => $birthDate->format('Y-m-d'),
                'customer_phone' => '52446677',
                'email' => 'emiljensen@gmail.com',
                'gender' => PaymentRequestPayload\CustomerInfo::GENDER_MALE,
                'shipping_address' => 'Syrenvej 31',
                'shipping_city' => 'Aalborg',
                'shipping_country' => 'DK',
                'shipping_firstname' => 'Emil',
                'shipping_lastname' => 'Jensen',
                'shipping_postal' => '9000',
                'shipping_region' => 'Region Nord',
                'username' => 'emiljensen1972',
            ],
            'transaction_info' => [
                'info' => 'value'
            ],
            'orderLines' => [
                [
                    'description' => 'An even faster Santa Claus',
                    'itemId' => 'SantaClausTurbo',
                    'quantity' => 165.43,
                    'unitPrice' => 13.37,
                    // optional stuff
                    'taxAmount' => 0.42,
                    'unitCode' => 'kg',
                    'goodsType' => 'item',
                ], [
                    'description' => 'Shipping fee',
                    'itemId' => 'ShipShip',
                    'quantity' => 1.0,
                    'unitPrice' => 5.0,
                    // optional stuff
                    'goodsType' => 'shipment',
                ]
            ]
        ];


        $config = new PaymentRequestPayload\Config();
        $config
            ->setCallbackForm($expected['config']['callback_form'])
            ->setCallbackOk($expected['config']['callback_ok'])
            ->setCallbackFail($expected['config']['callback_fail'])
            ->setCallbackRedirect($expected['config']['callback_redirect'])
            ->setCallbackOpen($expected['config']['callback_open'])
            ->setCallbackNotification($expected['config']['callback_notification'])
            ->setCallbackVerifyOrder($expected['config']['callback_verify_order'])
        ;

        $customerInfo = new PaymentRequestPayload\CustomerInfo();
        $customerInfo
            ->setBankName($expected['customer_info']['bank_name'])
            ->setBankPhone($expected['customer_info']['bank_phone'])
            ->setEmail($expected['customer_info']['email'])
            ->setGender($expected['customer_info']['gender'])
            ->setBirthDate($birthDate)
            ->setUsername($expected['customer_info']['username'])
            ->setCustomerPhone($expected['customer_info']['customer_phone'])
            ->setBillingPostal($expected['customer_info']['billing_postal'])
            ->setBillingCountry($expected['customer_info']['billing_country'])
            ->setBillingAddress($expected['customer_info']['billing_address'])
            ->setBillingCity($expected['customer_info']['billing_city'])
            ->setBillingFirstName($expected['customer_info']['billing_firstname'])
            ->setBillingLastName($expected['customer_info']['billing_lastname'])
            ->setBillingRegion($expected['customer_info']['billing_region'])
            ->setShippingPostal($expected['customer_info']['shipping_postal'])
            ->setShippingCountry($expected['customer_info']['shipping_country'])
            ->setShippingAddress($expected['customer_info']['shipping_address'])
            ->setShippingCity($expected['customer_info']['shipping_city'])
            ->setShippingFirstName($expected['customer_info']['shipping_firstname'])
            ->setShippingLastName($expected['customer_info']['shipping_lastname'])
            ->setShippingRegion($expected['customer_info']['shipping_region'])
        ;

        $payload = new PaymentRequestPayload(
            $expected['terminal'],
            $expected['shop_orderid'],
            AltaPay\createMoneyFromFloat('DKK', $expected['amount']),
            $expected['currency']
        );
        $payload
            ->setAccountOffer($expected['account_offer'])
            ->setCcToken($expected['ccToken'])
            ->setConfig($config)
            ->setCookiePart('somecookie', 'cookievalue')
            ->setCustomerCreatedDate($customerCreatedDate)
            ->setCustomerInfo($customerInfo)
            ->setFraudService($expected['fraud_service'])
            ->setLanguage($expected['language'])
            ->setOrganisationNumber($expected['organisation_number'])
            ->setPaymentSource($expected['payment_source'])
            ->setSaleInvoiceNumber($expected['sale_invoice_number'])
            ->setSaleReconciliationIdentifier($expected['sale_reconciliation_identifier'])
            ->setSalesTax(AltaPay\createMoneyFromFloat('DKK', $expected['sales_tax']))
            ->setShippingMethod($expected['shipping_method'])
            ->setTransactionInfo($expected['transaction_info'])
            ->setType($expected['type'])
            ->setCustomerInfo($customerInfo)
            ->setConfig($config)
        ;

        foreach ($expected['orderLines'] as $orderLine) {
            $ol = new OrderLine(
                $orderLine['description'],
                $orderLine['itemId'],
                $orderLine['quantity'],
                AltaPay\createMoneyFromFloat('DKK', $orderLine['unitPrice'])
            );
            if (isset($orderLine['taxPercent'])) {
                $ol->setTaxPercent($orderLine['taxPercent']);
            }
            if (isset($orderLine['taxAmount'])) {
                $ol->setTaxAmount(AltaPay\createMoneyFromFloat('DKK', $orderLine['taxAmount']));
            }
            if (isset($orderLine['unitCode'])) {
                $ol->setUnitCode($orderLine['unitCode']);
            }
            if (isset($orderLine['discount'])) {
                $ol->setDiscount($orderLine['discount']);
            }
            if (isset($orderLine['goodsType'])) {
                $ol->setGoodsType($orderLine['goodsType']);
            }
            if (isset($orderLine['imageUrl'])) {
                $ol->setImageUrl($orderLine['imageUrl']);
            }
            $payload->addOrderLine($ol);
        }

        $this->assertEquals($expected, $payload->getPayload());
    }

    public function testParseCookieParts()
    {
        $cookieParts = [
            'key1' => 'val1',
            'key2' => 'val2',
            'key3' => 'http://www.example.com'
        ];
        $actual = PaymentRequestPayload::parseCookieParts($cookieParts);

        $expected = 'key1=val1;key2=val2;key3=http%3A%2F%2Fwww.example.com';

        $this->assertEquals($expected, $actual);
    }
}
