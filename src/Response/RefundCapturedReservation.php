<?php
namespace Loevgaard\AltaPay\Response;

use Loevgaard\AltaPay;
use Loevgaard\AltaPay\Entity\ResultTrait;
use Loevgaard\AltaPay\Entity\TransactionsTrait;
use Money\Money;

class RefundCapturedReservation extends Response
{
    use ResultTrait;
    use TransactionsTrait;

    /**
     * @var Money
     */
    protected $refundAmount;

    /**
     * @var int
     */
    protected $refundCurrency;

    /**
     * @deprecated
     * @var string
     */
    protected $refundResult;

    /**
     * @return Money
     */
    public function getRefundAmount(): Money
    {
        return $this->refundAmount;
    }

    /**
     * @return int
     */
    public function getRefundCurrency(): int
    {
        return $this->refundCurrency;
    }

    /**
     * @deprecated
     * @return string
     */
    public function getRefundResult(): string
    {
        return $this->refundResult;
    }

    protected function init()
    {
        /** @var \SimpleXMLElement $body */
        $body = $this->xmlDoc->Body;

        $currency = (int)$body->RefundCurrency;
        $alphaCurrency = AltaPay\alphaCurrencyFromNumeric($currency);

        $this->refundAmount = AltaPay\createMoneyFromFloat($alphaCurrency, (float)$body->RefundAmount);
        $this->refundCurrency = $currency;
        $this->refundResult = (string)$body->RefundResult;
        $this->hydrateTransactions($body);
    }
}
