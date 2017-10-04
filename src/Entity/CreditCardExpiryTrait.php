<?php

namespace Loevgaard\AltaPay\Entity;

trait CreditCardExpiryTrait
{
    /**
     * @var CreditCardExpiry
     */
    private $creditCardExpiry;


    public function hydrateCreditCardExpiry(\SimpleXMLElement $xml)
    {
        $creditCardExpiry = new CreditCardExpiry();
        $creditCardExpiry->hydrateXml($xml);

        $this->creditCardExpiry = $creditCardExpiry;
    }

    /**
     * @return CreditCardExpiry
     */
    public function getCreditCardExpiry() : CreditCardExpiry
    {
        return $this->creditCardExpiry;
    }
}
