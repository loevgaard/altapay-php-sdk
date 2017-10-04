<?php
namespace Loevgaard\AltaPay\Entity;

use Loevgaard\AltaPay\Hydrator\HydratableInterface;

class CountryOfOrigin implements HydratableInterface
{
    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $source;

    public function hydrateXml(\SimpleXMLElement $xml)
    {
        $this->country = (string)$xml->CountryOfOrigin->Country;
        $this->source = (string)$xml->CountryOfOrigin->Source;
    }

    /**
     * @return string
     */
    public function getCountry() : string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getSource() : string
    {
        return $this->source;
    }
}
