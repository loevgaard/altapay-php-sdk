<?php

namespace Loevgaard\AltaPay\Entity;

use Loevgaard\AltaPay\Hydrator\HydratableInterface;

class ShippingAddress implements HydratableInterface
{
    use AddressTrait;

    public function hydrateXml(\SimpleXMLElement $xml)
    {
        if (isset($xml->ShippingAddress)) {
            /** @var \SimpleXMLElement $shippingAddress */
            $shippingAddress = $xml->ShippingAddress;
            
            $this->hydrateAddress($shippingAddress);
        }
    }
}
