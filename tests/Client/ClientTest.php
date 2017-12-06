<?php

namespace Loevgaard\AltaPay\Client;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Loevgaard\AltaPay\Entity\Currency;
use Loevgaard\AltaPay\Entity\Nature;
use Loevgaard\AltaPay\Entity\Terminal;
use Loevgaard\AltaPay\Payload\CaptureReservation;
use Loevgaard\AltaPay\Payload\PaymentRequest as PaymentRequestPayload;
use Loevgaard\AltaPay\Payload\RefundCapturedReservation;
use Loevgaard\AltaPay\Response\CaptureReservation as CaptureReservationResponse;
use Loevgaard\AltaPay\Response\GetTerminals as GetTerminalsResponse;
use Loevgaard\AltaPay\Response\PaymentRequest as PaymentRequestResponse;
use Loevgaard\AltaPay\Response\RefundCapturedReservation as RefundCapturedReservationResponse;
use Money\Money;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{
    public function testGettersSetters()
    {
        $defaultOptions = [
            'key' => 'val'
        ];

        $client = $this->getClient();
        $client->setDefaultOptions($defaultOptions);

        $this->assertSame($defaultOptions, $client->getDefaultOptions());
    }

    public function testCreatePaymentRequest()
    {
        $xml = file_get_contents(__DIR__.'/../data/PaymentRequestResponse.xml');

        $mock = new MockHandler([
            new Response(200, [], $xml)
        ]);

        $handler = HandlerStack::create($mock);

        $client = $this->getClient($handler);
        $payload = new PaymentRequestPayload('Terminal', time(), new Money(10050, new \Money\Currency('DKK')));
        $response = $client->createPaymentRequest($payload);

        $this->assertInstanceOf(PaymentRequestResponse::class, $response);
        $this->assertTrue($response->isSuccessful());

        // @todo create more assertions
    }

    public function testCaptureReservation()
    {
        $xml = file_get_contents(__DIR__.'/../data/CaptureReservationResponse.xml');

        $mock = new MockHandler([
            new Response(200, [], $xml)
        ]);

        $handler = HandlerStack::create($mock);

        $client = $this->getClient($handler);

        $payload = new CaptureReservation('transaction_id');
        $response = $client->captureReservation($payload);
        $this->assertInstanceOf(CaptureReservationResponse::class, $response);
        $this->assertTrue($response->isSuccessful());

        // @todo move assertions from Response\CaptureReservationTest.php to here
    }

    public function testRefundCapturedReservation()
    {
        $xml = file_get_contents(__DIR__.'/../data/RefundCapturedReservationResponse.xml');

        $mock = new MockHandler([
            new Response(200, [], $xml)
        ]);

        $handler = HandlerStack::create($mock);

        $client = $this->getClient($handler);

        $payload = new RefundCapturedReservation('transaction_id');
        $response = $client->refundCapturedReservation($payload);
        $this->assertInstanceOf(RefundCapturedReservationResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
    }

    public function testGetTerminals()
    {
        $xml = file_get_contents(__DIR__.'/../data/GetTerminalsResponse.xml');

        $mock = new MockHandler([
            new Response(200, [], $xml)
        ]);

        $handler = HandlerStack::create($mock);

        $client = $this->getClient($handler);
        $response = $client->getTerminals();

        $this->assertInstanceOf(GetTerminalsResponse::class, $response);
        $this->assertTrue($response->isSuccessful());

        $this->assertEquals('Success', $response->getResult());

        // test terminals
        $terminals = $response->getTerminals();
        $this->assertInternalType('array', $terminals);
        $this->assertNotEmpty($terminals);
        $this->assertCount(2, $terminals);

        // test first terminal
        /** @var Terminal $terminal */
        $terminal = $terminals[0];
        $this->assertEquals('AltaPay Multi-Nature Terminal', $terminal->getTitle());
        $this->assertEquals('DK', $terminal->getCountry());

        // test natures of first terminal
        $natures = $terminal->getNatures();
        $this->assertInternalType('array', $natures);
        $this->assertNotEmpty($natures);
        $this->assertCount(4, $natures);

        // test first nature of first terminal
        /** @var Nature $nature */
        $nature = $natures[0];
        $this->assertEquals('CreditCard', $nature->getNature());

        // test currencies of first terminal
        $currencies = $terminal->getCurrencies();
        $this->assertInternalType('array', $currencies);
        $this->assertNotEmpty($currencies);
        $this->assertCount(2, $currencies);

        // test first currency of first terminal
        /** @var Currency $currency */
        $currency = $currencies[0];
        $this->assertEquals('DKK', $currency->getCurrency());
    }

    public function testGetClient()
    {
        $client = $this->getClient();

        $this->assertInstanceOf(GuzzleClient::class, $client->getClient());
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
