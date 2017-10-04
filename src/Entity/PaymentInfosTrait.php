<?php

namespace Loevgaard\AltaPay\Entity;

trait PaymentInfosTrait
{
    /**
     * @var PaymentInfo[]
     */
    protected $paymentInfos;

    /**
     * @return PaymentInfo[]
     */
    public function getPaymentInfos(): array
    {
        $this->initializePaymentInfos();

        return $this->paymentInfos;
    }

    /**
     * @param array $paymentInfos
     */
    public function setPaymentInfos(array $paymentInfos)
    {
        $this->paymentInfos = $paymentInfos;
    }

    /**
     * @param PaymentInfo $paymentInfo
     */
    public function addPaymentInfo(PaymentInfo $paymentInfo)
    {
        $this->initializePaymentInfos();

        $this->paymentInfos[] = $paymentInfo;
    }

    public function hydratePaymentInfos(\SimpleXMLElement $xml)
    {
        $this->initializePaymentInfos();

        if (isset($xml->PaymentInfos) && isset($xml->PaymentInfos->PaymentInfo) && !empty($xml->PaymentInfos->PaymentInfo)) {
            foreach ($xml->PaymentInfos->PaymentInfo as $paymentInfoXml) {
                $paymentInfo = new PaymentInfo();
                $paymentInfo->hydrateXml($paymentInfoXml);
                $this->paymentInfos[] = $paymentInfo;
            }
        }
    }

    private function initializePaymentInfos()
    {
        if (is_null($this->paymentInfos)) {
            $this->paymentInfos = [];
        }
    }
}
