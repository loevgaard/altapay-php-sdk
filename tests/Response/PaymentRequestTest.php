<?php

namespace Loevgaard\AltaPay\Response;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * @todo move assertions to ClientTest.php
 * @deprecated
 */
final class PaymentRequestTest extends TestCase
{
    public function testGetters()
    {
        $xml = file_get_contents(__DIR__.'/../data/PaymentRequestResponse.xml');

        $response = new \GuzzleHttp\Psr7\Response(200, [], $xml);
        $paymentRequestResponse = new PaymentRequest($response);

        $this->assertInstanceOf(PsrResponseInterface::class, $paymentRequestResponse->getResponse());
        $this->assertTrue(is_string($paymentRequestResponse->getResult()));
        $this->assertEquals('Success', $paymentRequestResponse->getResult());
        $this->assertTrue(is_string($paymentRequestResponse->getPaymentRequestId()));

        $this->assertNotFalse(filter_var($paymentRequestResponse->getUrl(), FILTER_VALIDATE_URL));
        $this->assertNotFalse(filter_var($paymentRequestResponse->getDynamicJavascriptUrl(), FILTER_VALIDATE_URL));
    }
}
