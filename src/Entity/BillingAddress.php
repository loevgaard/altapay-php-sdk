<?php

namespace Loevgaard\AltaPay\Entity;

use Loevgaard\AltaPay\Hydrator\HydratableInterface;

class BillingAddress implements HydratableInterface
{
    use AddressTrait;

    public function hydrateXml(\SimpleXMLElement $xml)
    {
        if (!isset($xml->BillingAddress)) {
            return;
        }

        /** @var \SimpleXMLElement $billingAddress */
        $billingAddress = $xml->BillingAddress;

        $this->hydrateAddress($billingAddress);
    }
}
