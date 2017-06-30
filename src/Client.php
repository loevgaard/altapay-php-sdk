<?php
namespace Loevgaard\AltaPay;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use Loevgaard\AltaPay\Payload\CaptureReservationInterface;
use Loevgaard\AltaPay\Payload\PaymentRequestInterface;
use Loevgaard\AltaPay\Response\PaymentRequest as PaymentRequestResponse;
use Loevgaard\AltaPay\Response\CaptureReservation as CaptureReservationResponse;
use Loevgaard\AltaPay\Response\GetTerminals as GetTerminalsResponse;
use Psr\Http\Message\ResponseInterface;

class Client
{
    /**
     * @var GuzzleClientInterface
     */
    protected $client;

    /**
     * Your username for the AltaPay gateway
     *
     * @var string
     */
    private $username;

    /**
     * Your password for the AltaPay gateway
     *
     * @var string
     */
    private $password;

    /**
     * The URL for the gateway
     * The default value for this is the test gateway URL
     *
     * @var string
     */
    private $baseUrl;

    public function __construct($username, $password, $baseUrl = 'https://testgateway.altapaysecure.com')
    {
        $this->username = $username;
        $this->password = $password;

        $parsedBaseUrl = parse_url($baseUrl);
        $baseUrl = $parsedBaseUrl['scheme'].
            '://'.rawurlencode($this->username).':'.rawurlencode($this->password).'@'.$parsedBaseUrl['host'];

        $this->baseUrl  = $baseUrl;
    }

    /**
     * @param PaymentRequestInterface $paymentRequest
     * @return PaymentRequestResponse
     */
    public function createPaymentRequest(PaymentRequestInterface $paymentRequest) : PaymentRequestResponse
    {
        $response = new PaymentRequestResponse($this->doRequest('post', '/merchant/API/createPaymentRequest', [
            'form_params' => $paymentRequest->getPayload()
        ]));
        return $response;
    }

    /**
     * @codeCoverageIgnore
     */
    public function testConnection()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @codeCoverageIgnore
     */
    public function login()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @codeCoverageIgnore
     */
    public function payments()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @param CaptureReservationInterface $captureReservation
     * @return CaptureReservationResponse
     */
    public function captureReservation(CaptureReservationInterface $captureReservation) : CaptureReservationResponse
    {
        return new CaptureReservationResponse($this->doRequest('get', '/merchant/API/captureReservation', [
            'query' => $captureReservation->getPayload()
        ]));
    }

    /**
     * @codeCoverageIgnore
     */
    public function releaseReservation()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @codeCoverageIgnore
     */
    public function refundCapturedReservation()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @codeCoverageIgnore
     */
    public function setupSubscription()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @codeCoverageIgnore
     */
    public function chargeSubscription()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @codeCoverageIgnore
     */
    public function reserveSubscriptionCharge()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @codeCoverageIgnore
     */
    public function updateOrder()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @codeCoverageIgnore
     */
    public function fundingList()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @codeCoverageIgnore
     */
    public function fundingDownload()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @codeCoverageIgnore
     */
    public function getCustomReport()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @codeCoverageIgnore
     */
    public function reservationOfFixedAmount()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @codeCoverageIgnore
     */
    public function credit()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @return GetTerminalsResponse
     */
    public function getTerminals() : GetTerminalsResponse
    {
        return new GetTerminalsResponse($this->doRequest('get', '/merchant/API/getTerminals'));
    }

    /**
     * @codeCoverageIgnore
     */
    public function getInvoiceText()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @codeCoverageIgnore
     */
    public function createInvoiceReservation()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @codeCoverageIgnore
     */
    public function calculateSurcharge()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @codeCoverageIgnore
     */
    public function queryGiftCard()
    {
        // @todo Implement method
        throw new \RuntimeException('Method is not implemented');
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array|null $options
     * @return ResponseInterface
     */
    public function doRequest($method, $uri, array $options = null)
    {

        $url = $this->baseUrl.$uri;
        $options = $options ? : [];
        $defaultOptions = [];
        $options = array_merge($defaultOptions, $options);
        $client = $this->getClient();
        return $client->request($method, $url, $options);
    }

    /**
     * @return GuzzleClientInterface
     */
    public function getClient()
    {
        if (!$this->client) {
            $this->client = new GuzzleClient([
                'allow_redirects' => false,
                'cookies' => false,
            ]);
        }
        return $this->client;
    }

    /**
     * @param GuzzleClientInterface $client
     * @return Client
     */
    public function setClient(GuzzleClientInterface $client)
    {
        $this->client = $client;
        return $this;
    }
}
