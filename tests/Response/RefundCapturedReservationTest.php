<?php

namespace Loevgaard\AltaPay\Response;

use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

final class RefundCapturedReservationTest extends TestCase
{
    public function testGetters()
    {
        // this xml is taken from the example found here:
        // https://testgateway.altapaysecure.com/merchant/help/Merchant_API#API_captureReservation
        $xml = file_get_contents(__DIR__.'/../data/RefundCapturedReservationResponse.xml');

        $response = new \GuzzleHttp\Psr7\Response(200, [], $xml);
        $refundCapturedReservationResponse = new RefundCapturedReservation($response);

        $this->assertInstanceOf(PsrResponseInterface::class, $refundCapturedReservationResponse->getResponse());

        $refundAmount = new Money('12', new Currency('EUR'));

        $this->assertEquals($refundAmount, $refundCapturedReservationResponse->getRefundAmount());
        $this->assertSame(978, $refundCapturedReservationResponse->getRefundCurrency());
        $this->assertSame('Success', $refundCapturedReservationResponse->getRefundResult());
    }
}
