<?php

namespace Loevgaard\AltaPay;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Loevgaard\AltaPay\Payload\PaymentRequest as PaymentRequestPayload;
use Loevgaard\AltaPay\Response\PaymentRequest as PaymentRequestResponse;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client as GuzzleClient;

final class ClientTest extends TestCase
{
    public function testCreatePaymentRequest()
    {
        $xml = file_get_contents(__DIR__.'/data/PaymentRequestResponse.xml');

        $mock = new MockHandler([
            new Response(200, [], $xml)
        ]);

        $handler = HandlerStack::create($mock);

        $client = $this->getClient($handler);
        $payload = new PaymentRequestPayload('Terminal', time(), 100.5, 'DKK');
        $response = $client->createPaymentRequest($payload);

        $this->assertInstanceOf(PaymentRequestResponse::class, $response);
        $this->assertTrue($response->isSuccessful());

        // @todo create more assertions
    }

    public function testCaptureReservation()
    {
        $client = $this->getClient();
        //$response = $client->captureReservation(new CaptureReservationPayload());
    }

    /******************
     * HELPER METHODS *
     *****************/

    /**
     * @param HandlerStack|null $handler
     * @return Client
     */
    private function getClient(HandlerStack $handler = null)
    {
        $client =  new Client('Username', 'Password');
        if ($handler) {
            $guzzleClient = new GuzzleClient([
                'handler' => $handler
            ]);
            $client->setClient($guzzleClient);
        }
        return $client;
    }
}
