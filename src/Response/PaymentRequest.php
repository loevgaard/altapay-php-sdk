<?php
namespace Loevgaard\AltaPay\Response;

use Loevgaard\AltaPay\Entity\ResultTrait;

class PaymentRequest extends Response
{
    use ResultTrait;

    /**
     * @var string
     */
    protected $paymentRequestId;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $dynamicJavascriptUrl;

    /**
     * @return string
     */
    public function getPaymentRequestId() : string
    {
        return $this->paymentRequestId;
    }

    /**
     * @return string
     */
    public function getUrl() : string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getDynamicJavascriptUrl() : string
    {
        return $this->dynamicJavascriptUrl;
    }

    protected function init()
    {
        /** @var \SimpleXMLElement $body */
        $body = $this->xmlDoc->Body;

        $this->paymentRequestId     = (string)$body->PaymentRequestId;
        $this->url                  = (string)$body->Url;
        $this->dynamicJavascriptUrl = (string)$body->DynamicJavascriptUrl;
        $this->hydrateResult($body);
    }
}
