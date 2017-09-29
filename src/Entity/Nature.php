<?php
namespace Loevgaard\AltaPay\Entity;

use Loevgaard\AltaPay\Hydrator\HydratableInterface;

class Nature implements HydratableInterface
{
    /**
     * @var string
     */
    protected $nature;

    public function __toString() : string
    {
        return (string)$this->nature;
    }

    public function hydrateXml(\SimpleXMLElement $xml)
    {
        $this->nature = (string)$xml;
    }

    /**
     * @return string
     */
    public function getNature(): string
    {
        return $this->nature;
    }
}
