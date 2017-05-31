<?php

namespace Loevgaard\AltaPay;

use Loevgaard\AltaPay\Payload\PaymentRequest as PaymentRequestPayload;
use Loevgaard\AltaPay\Response\PaymentRequest as PaymentRequestResponse;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{
    public function testCreatePaymentRequest() {
        $client = $this->getClient();
        $payload = PaymentRequestPayload::create(getenv('ALTAPAY_TERMINAL'), time(), 100.5, 'DKK');
        $response = $client->createPaymentRequest($payload);

        $this->assertInstanceOf(PaymentRequestResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
    }

    /**
     * @return Client
     */
    private function getClient() {
        return new Client(getenv('ALTAPAY_USERNAME'), getenv('ALTAPAY_PASSWORD'));
    }

    /*public function testCanBeCreatedFromValidEmailAddress()
    {
        $this->assertInstanceOf(
            Email::class,
            Email::fromString('user@example.com')
        );
    }

    public function testCannotBeCreatedFromInvalidEmailAddress()
    {
        $this->expectException(InvalidArgumentException::class);

        Email::fromString('invalid');
    }

    public function testCanBeUsedAsString()
    {
        $this->assertEquals(
            'user@example.com',
            Email::fromString('user@example.com')
        );
    }*/
}