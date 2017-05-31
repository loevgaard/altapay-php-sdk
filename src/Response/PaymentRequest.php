<?php
namespace Loevgaard\AltaPay\Response;

class PaymentRequest extends Response
{
    const RESULT_SUCCESS = 'Success';

    /**
     * @var string
     */
    protected $result;

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

    protected function init() {
        $this->result               = (string)$this->xmlDoc->Body->Result;
        $this->paymentRequestId     = (string)$this->xmlDoc->Body->PaymentRequestId;
        $this->url                  = (string)$this->xmlDoc->Body->Url;
        $this->dynamicJavascriptUrl = (string)$this->xmlDoc->Body->DynamicJavascriptUrl;
    }

    public function isSuccessful()
    {
        return parent::isSuccessful() && $this->result === self::RESULT_SUCCESS;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return string
     */
    public function getPaymentRequestId()
    {
        return $this->paymentRequestId;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getDynamicJavascriptUrl()
    {
        return $this->dynamicJavascriptUrl;
    }
}