<?php
namespace Loevgaard\AltaPay\Entity;

use Loevgaard\AltaPay;
use Loevgaard\AltaPay\Exception\XmlException;
use Loevgaard\AltaPay\Hydrator\HydratableInterface;
use Money\Money;

class ReconciliationIdentifier implements HydratableInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var Money
     */
    private $amount;

    /**
     * @var int
     */
    private $amountCurrency;

    /**
     * @var string
     */
    private $type;

    /**
     * @var \DateTimeImmutable
     */
    private $date;

    public function hydrateXml(\SimpleXMLElement $xml)
    {
        $currency = (int)$xml->Amount['currency'];
        $alphaCurrency = AltaPay\alphaCurrencyFromNumeric($currency);

        $this->id = (string)$xml->Id;
        $this->amount = AltaPay\createMoneyFromFloat($alphaCurrency, (float)$xml->Amount);
        $this->amountCurrency = $currency;
        $this->type = (string)$xml->Type;

        $this->date = \DateTimeImmutable::createFromFormat(DATE_RFC3339, (string)$xml->Date);
        if ($this->date === false) {
            $exception = new XmlException('The date format is wrong');
            $exception->setXmlElement($xml);
            throw $exception;
        }
    }

    /**
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * @return Money
     */
    public function getAmount() : Money
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getAmountCurrency() : int
    {
        return $this->amountCurrency;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }
}
