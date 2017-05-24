<?php
namespace Loevgaard\AltaPay\Response;

use Psr\Http\Message\ResponseInterface;

class PaymentRequest
{
    /** @var ResponseInterface */
    private $response;

    /** @var string */
    private $result;

    /** @var string */
    private $paymentRequestId;

    /** @var string */
    private $url;

    /** @var string */
    private $dynamicJavascriptUrl;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $this->parseXml();
    }

    private function parseXml() {
        $xml                        = (string)$this->response->getBody();
        $xmlDoc                     = new \SimpleXMLElement($xml);
        $this->result               = $xmlDoc->Body->Result;
        $this->paymentRequestId     = $xmlDoc->Body->PaymentRequestId;
        $this->url                  = $xmlDoc->Body->Url;
        $this->dynamicJavascriptUrl = $xmlDoc->Body->DynamicJavascriptUrl;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param ResponseInterface $response
     * @return PaymentRequest
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param string $result
     * @return PaymentRequest
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentRequestId()
    {
        return $this->paymentRequestId;
    }

    /**
     * @param string $paymentRequestId
     * @return PaymentRequest
     */
    public function setPaymentRequestId($paymentRequestId)
    {
        $this->paymentRequestId = $paymentRequestId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return PaymentRequest
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getDynamicJavascriptUrl()
    {
        return $this->dynamicJavascriptUrl;
    }

    /**
     * @param string $dynamicJavascriptUrl
     * @return PaymentRequest
     */
    public function setDynamicJavascriptUrl($dynamicJavascriptUrl)
    {
        $this->dynamicJavascriptUrl = $dynamicJavascriptUrl;
        return $this;
    }
}