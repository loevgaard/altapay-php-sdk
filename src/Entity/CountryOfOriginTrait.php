<?php

namespace Loevgaard\AltaPay\Entity;

trait CountryOfOriginTrait
{
    /**
     * @var CountryOfOrigin
     */
    private $countryOfOrigin;


    public function hydrateCountryOfOrigin(\SimpleXMLElement $xml)
    {
        $countryOfOrigin = new CountryOfOrigin();
        $countryOfOrigin->hydrateXml($xml);

        $this->countryOfOrigin = $countryOfOrigin;
    }

    /**
     * @return CountryOfOrigin
     */
    public function getCountryOfOrigin() : CountryOfOrigin
    {
        return $this->countryOfOrigin;
    }
}
