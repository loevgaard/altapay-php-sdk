<?php

namespace Loevgaard\AltaPay\Payload;

use Loevgaard\AltaPay\Payload\PaymentRequest as PaymentRequestPayload;
use PHPUnit\Framework\TestCase;

final class PaymentRequestTest extends TestCase
{
    public function testGetPayload() {
        $birthDate = \DateTime::createFromFormat('Y-m-d', '1972-05-22');
        $expected = [
            'shop_orderid' => time(),
            'amount' => 100.5,
            'currency' => 'DKK',
            'terminal' => getenv('ALTAPAY_TERMINAL'),
            'account_offer' => 'account offer',
            'ccToken' => 'cc token',
            'language' => 'da',
            'cookie' => 'somecookie=cookievalue',
            'customer_created_date' => '2017-05-31',
            'fraud_service' => 'fraud service',
            'organisation_number' => 'DK123123123',
            'payment_source' => PaymentRequest::PAYMENT_SOURCE_ECOMMERCE,
            'sale_invoice_number' => 'INV2020202',
            'sale_reconciliation_identifier' => 'IDNT98721',
            'sales_tax' => 20.5,
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
                    'quantity' => 1,
                    'unitPrice' => 5,
                    // optional stuff
                    'goodsType' => 'shipment',
                ]
            ]
        ];


        $config = new PaymentRequestPayload\Config(
            $expected['config']['callback_form'],
            $expected['config']['callback_ok'],
            $expected['config']['callback_fail'],
            $expected['config']['callback_redirect'],
            $expected['config']['callback_open'],
            $expected['config']['callback_notification'],
            $expected['config']['callback_verify_order']
        );

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

        $payload = PaymentRequestPayload::create($expected['terminal'], $expected['shop_orderid'], $expected['amount'], $expected['currency']);
        $payload
            ->setAccountOffer($expected['account_offer'])
            ->setCcToken($expected['ccToken'])
            ->setConfig($config)
            ->setCookie($expected['cookie'])
            ->setCustomerCreatedDate($expected['customer_created_date'])
            ->setCustomerInfo($customerInfo)
            ->setFraudService($expected['fraud_service'])
            ->setLanguage($expected['language'])
            ->setOrganisationNumber($expected['organisation_number'])
            ->setPaymentSource($expected['payment_source'])
            ->setSaleInvoiceNumber($expected['sale_invoice_number'])
            ->setSaleReconciliationIdentifier($expected['sale_reconciliation_identifier'])
            ->setSalesTax($expected['sales_tax'])
            ->setShippingMethod($expected['shipping_method'])
            ->setTransactionInfo($expected['transaction_info'])
            ->setType($expected['type'])
            ->setCustomerInfo($customerInfo)
            ->setConfig($config)
        ;

        foreach ($expected['orderLines'] as $orderLine) {
            $ol = new PaymentRequestPayload\OrderLine(
                $orderLine['description'],
                $orderLine['itemId'],
                $orderLine['quantity'],
                $orderLine['unitPrice'],
                isset($orderLine['taxPercent']) ? $orderLine['taxPercent'] : null,
                isset($orderLine['taxAmount']) ? $orderLine['taxAmount'] : null,
                isset($orderLine['unitCode']) ? $orderLine['unitCode'] : null,
                isset($orderLine['discount']) ? $orderLine['discount'] : null,
                isset($orderLine['goodsType']) ? $orderLine['goodsType'] : null,
                isset($orderLine['imageUrl']) ? $orderLine['imageUrl'] : null
            );
            $payload->addOrderLine($ol);
        }

        $this->assertEquals($expected, $payload->getPayload());
    }
}