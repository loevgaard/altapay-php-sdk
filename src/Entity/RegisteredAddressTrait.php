<?php

namespace Loevgaard\AltaPay\Entity;

trait RegisteredAddressTrait
{
    /**
     * @var RegisteredAddress
     */
    private $registeredAddress;


    public function hydrateRegisteredAddress(\SimpleXMLElement $xml)
    {
        $registeredAddress = new RegisteredAddress();
        $registeredAddress->hydrateXml($xml);

        $this->registeredAddress = $registeredAddress;
    }

    /**
     * @return RegisteredAddress
     */
    public function getRegisteredAddress() : RegisteredAddress
    {
        return $this->registeredAddress;
    }
}
