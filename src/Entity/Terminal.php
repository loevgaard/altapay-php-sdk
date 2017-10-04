<?php
namespace Loevgaard\AltaPay\Entity;

use Loevgaard\AltaPay\Hydrator\HydratableInterface;

class Terminal implements HydratableInterface
{
    use CurrenciesTrait;
    use NaturesTrait;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $country;

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getCountry() : string
    {
        return $this->country;
    }

    public function hydrateXml(\SimpleXMLElement $xml)
    {
        $this->title = (string)$xml->Title;
        $this->country = (string)$xml->Country;
        $this->hydrateCurrencies($xml);
        $this->hydrateNatures($xml);
    }
}
