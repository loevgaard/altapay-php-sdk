<?php
namespace Loevgaard\AltaPay\Entity;

class Currency
{
    /**
     * @var string
     */
    protected $currency;

    public function __toString() : string
    {
        return (string)$this->currency;
    }

    public function hydrateXml(\SimpleXMLElement $xml)
    {
        $this->currency = (string)$xml;
    }

    /**
     * @return string
     */
    public function getCurrency() : string
    {
        return $this->currency;
    }
}
