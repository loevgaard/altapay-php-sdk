<?php

namespace Loevgaard\AltaPay;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Loevgaard\AltaPay\Payload\PaymentRequest as PaymentRequestPayload;
use Loevgaard\AltaPay\Response\PaymentRequest as PaymentRequestResponse;
use Loevgaard\AltaPay\Response\GetTerminals as GetTerminalsResponse;
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

    public function testGetTerminals()
    {
        $xml = file_get_contents(__DIR__.'/data/GetTerminalsResponse.xml');

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
        /** @var GetTerminalsResponse\Terminal $terminal */
        $terminal = $terminals[0];
        $this->assertEquals('AltaPay Multi-Nature Terminal', $terminal->getTitle());
        $this->assertEquals('DK', $terminal->getCountry());

        // test natures of first terminal
        $natures = $terminal->getNatures();
        $this->assertInternalType('array', $natures);
        $this->assertNotEmpty($natures);
        $this->assertCount(4, $natures);

        // test first nature of first terminal
        /** @var GetTerminalsResponse\Terminal\Nature $nature */
        $nature = $natures[0];
        $this->assertEquals('CreditCard', $nature->getNature());

        // test currencies of first terminal
        $currencies = $terminal->getCurrencies();
        $this->assertInternalType('array', $currencies);
        $this->assertNotEmpty($currencies);
        $this->assertCount(2, $currencies);

        // test first currency of first terminal
        /** @var GetTerminalsResponse\Terminal\Currency $currency */
        $currency = $currencies[0];
        $this->assertEquals('DKK', $currency->getCurrency());
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
