<?php

namespace Loevgaard\AltaPay;

use Loevgaard\AltaPay\Payload\PaymentRequest as PaymentRequestPayload;
use Loevgaard\AltaPay\Payload\CaptureReservation as CaptureReservationPayload;
use Loevgaard\AltaPay\Response\PaymentRequest as PaymentRequestResponse;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{
    /**
     * @var Client
     */
    private $client;

    public function testCreatePaymentRequest() {
        $response = $this->createPaymentRequest();

        $this->assertInstanceOf(PaymentRequestResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
    }

    // @todo figure out how to make a live capture to test properly
    public function testCaptureReservation() {
        $client = $this->getClient();
        //$response = $client->captureReservation(new CaptureReservationPayload());
    }

    /******************
     * HELPER METHODS *
     *****************/

    /**
     * @return PaymentRequestResponse
     */
    private function createPaymentRequest() {
        $client = $this->getClient();
        $payload = new PaymentRequestPayload(getenv('ALTAPAY_TERMINAL'), time(), 100.5, 'DKK');
        return $client->createPaymentRequest($payload);
    }

    /**
     * @return Client
     */
    private function getClient() {
        if(!$this->client) {
            $this->client = new Client(getenv('ALTAPAY_USERNAME'), getenv('ALTAPAY_PASSWORD'));
        }
        return $this->client;
    }
}