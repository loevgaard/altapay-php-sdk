<?php

namespace Loevgaard\AltaPay\Entity;

trait BillingAddressTrait
{
    /**
     * @var BillingAddress
     */
    private $billingAddress;


    public function hydrateBillingAddress(\SimpleXMLElement $xml)
    {
        $billingAddress = new BillingAddress();
        $billingAddress->hydrateXml($xml);

        $this->billingAddress = $billingAddress;
    }

    /**
     * @return BillingAddress
     */
    public function getBillingAddress() : BillingAddress
    {
        return $this->billingAddress;
    }
}
