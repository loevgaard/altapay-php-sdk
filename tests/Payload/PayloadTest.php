<?php

namespace Loevgaard\AltaPay\Payload;

use Loevgaard\AltaPay\Payload\PaymentRequest\CustomerInfo;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;

final class PayloadTest extends TestCase
{
    public function testGetPayload()
    {
        $mock = $this->getPayloadStub();
        $this->assertTrue(is_array($mock->getPayload()));
    }

    public function testSimplePayload()
    {
        $customerInfoPayload = new CustomerInfo();
        $customerInfoPayload->setBillingFirstName('First name');
        $customerInfoPayload->setBillingLastName('');

        $arr = [
            'elm1' => 'val1',
            'elm2' => null,
            'elm3' => [],
            'elm4' => ['nested'],
            'elm5' => '',
            'elm6' => $customerInfoPayload,
        ];

        $this->assertSame([
            'elm1' => 'val1',
            'elm4' => ['nested'],
            'elm6' => ['billing_firstname' => 'First name'],
        ], Payload::simplePayload($arr));
    }

    public function testSimplePayloadWithObjects()
    {
        $customerInfoPayload = new CustomerInfo();
        $customerInfoPayload->setBillingFirstName('First name');
        $customerInfoPayload->setBillingLastName('');

        $amount = new Money(10000, new Currency('DKK'));

        $paymentRequestPayload = new PaymentRequest('terminal', 'order123', $amount);
        $paymentRequestPayload->setCustomerInfo($customerInfoPayload);

        $expected = [
            'terminal' => 'terminal',
            'shop_orderid' => 'order123',
            'amount' => 100.0,
            'currency' => 'DKK',
            'customer_info' => [
                'billing_firstname' => 'First name'
            ],
        ];

        $this->assertSame($expected, $paymentRequestPayload->getPayload());
    }

    /**
     * @return Payload|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getPayloadStub()
    {
        return $this->getMockForAbstractClass(Payload::class);
    }
}
