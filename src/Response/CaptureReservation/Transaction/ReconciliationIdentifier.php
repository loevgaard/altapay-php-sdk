<?php
namespace Loevgaard\AltaPay\Response\CaptureReservation\Transaction;

use Loevgaard\AltaPay\Exception\ResponseException;
use Loevgaard\AltaPay\Response\PartialResponse;

class ReconciliationIdentifier extends PartialResponse
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var float
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

    protected function init()
    {
        $this->id = (string)$this->xmlDoc->Id;
        $this->amount = (float)$this->xmlDoc->Amount;
        $this->amountCurrency = (int)$this->xmlDoc->Amount['currency'];
        $this->type = (string)$this->xmlDoc->Type;

        $this->date = \DateTimeImmutable::createFromFormat(DATE_RFC3339, (string)$this->xmlDoc->Date);
        if ($this->date === false) {
            $exception = new ResponseException('The date format is wrong');
            $exception->setResponse($this->getOriginalResponse());
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
     * @return float
     */
    public function getAmount() : float
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
