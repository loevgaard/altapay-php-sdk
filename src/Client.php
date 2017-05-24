<?php
namespace Loevgaard\AltaPay;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use Loevgaard\AltaPay\Payload\PayloadInterface;
use Loevgaard\AltaPay\Payload\PaymentRequestInterface;
use Loevgaard\AltaPay\Response\PaymentRequest as PaymentRequestResponse;
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
        $this->baseUrl  = $baseUrl;
    }

    /**
     * @param PaymentRequestInterface $paymentRequest
     * @return PaymentRequestResponse
     */
    public function createPaymentRequest(PaymentRequestInterface $paymentRequest) {
        return new PaymentRequestResponse($this->doRequest('post', '/merchant/API/createPaymentRequest', [
            'form_params' => $paymentRequest->getPayload()
        ]));
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array|null $options
     * @return ResponseInterface
     */
    public function doRequest($method = 'get', $uri, array $options = null) {
        $url = $this->baseUrl.$uri;
        $options = $options ? : [];
        $defaultOptions = [
            'auth' => [$this->username, $this->password]
        ];
        $options = array_merge($defaultOptions, $options);
        return $this->client->request($method, $url, $options);
    }

    /**
     * @return GuzzleClientInterface
     */
    public function getClient()
    {
        if(!$this->client) {
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
