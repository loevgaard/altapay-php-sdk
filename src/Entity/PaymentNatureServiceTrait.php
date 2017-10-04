<?php

namespace Loevgaard\AltaPay\Entity;

trait PaymentNatureServiceTrait
{
    /**
     * @var PaymentNatureService
     */
    private $paymentNatureService;


    public function hydratePaymentNatureService(\SimpleXMLElement $xml)
    {
        $paymentNatureService = new PaymentNatureService();
        $paymentNatureService->hydrateXml($xml);

        $this->paymentNatureService = $paymentNatureService;
    }

    /**
     * @return PaymentNatureService
     */
    public function getPaymentNatureService() : PaymentNatureService
    {
        return $this->paymentNatureService;
    }
}
