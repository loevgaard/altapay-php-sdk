<?php
namespace Loevgaard\AltaPay\Entity;

use Loevgaard\AltaPay\Hydrator\HydratableInterface;

class PaymentInfo implements HydratableInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue() : string
    {
        return $this->value;
    }

    public function hydrateXml(\SimpleXMLElement $xml)
    {
        $this->name = (string)$xml['name'];
        $this->value = (string)$xml;
    }
}
