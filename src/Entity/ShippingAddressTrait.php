<?php

namespace Loevgaard\AltaPay\Entity;

trait ShippingAddressTrait
{
    /**
     * @var ShippingAddress
     */
    private $shippingAddress;


    public function hydrateShippingAddress(\SimpleXMLElement $xml)
    {
        $shippingAddress = new ShippingAddress();
        $shippingAddress->hydrateXml($xml);

        $this->shippingAddress = $shippingAddress;
    }

    /**
     * @return ShippingAddress
     */
    public function getShippingAddress() : ShippingAddress
    {
        return $this->shippingAddress;
    }
}
