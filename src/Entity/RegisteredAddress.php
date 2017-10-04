<?php

namespace Loevgaard\AltaPay\Entity;

use Loevgaard\AltaPay\Hydrator\HydratableInterface;

class RegisteredAddress implements HydratableInterface
{
    use AddressTrait;

    public function hydrateXml(\SimpleXMLElement $xml)
    {
        if (!isset($xml->RegisteredAddress)) {
            return;
        }

        /** @var \SimpleXMLElement $registeredAddress */
        $registeredAddress = $xml->RegisteredAddress;

        $this->hydrateAddress($registeredAddress);
    }
}
