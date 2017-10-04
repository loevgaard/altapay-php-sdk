<?php
namespace Loevgaard\AltaPay\Entity;

use Loevgaard\AltaPay\Hydrator\HydratableInterface;

class CreditCardExpiry implements HydratableInterface
{
    /**
     * @var int
     */
    private $year;

    /**
     * @var int
     */
    private $month;

    public function hydrateXml(\SimpleXMLElement $xml)
    {
        if (!isset($xml->CreditCardExpiry)) {
            return;
        }

        $this->year = (string)$xml->CreditCardExpiry->Year;
        $this->month = (string)$xml->CreditCardExpiry->Month;
    }

    /**
     * @return int
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * @return int
     */
    public function getMonth(): ?int
    {
        return $this->month;
    }
}
