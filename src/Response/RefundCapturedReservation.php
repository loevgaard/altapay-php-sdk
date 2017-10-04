<?php
namespace Loevgaard\AltaPay\Response;

use Loevgaard\AltaPay\Entity\ResultTrait;
use Loevgaard\AltaPay\Entity\TransactionsTrait;

class RefundCapturedReservation extends Response
{
    use ResultTrait;
    use TransactionsTrait;

    /**
     * @var float
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
     * @return float
     */
    public function getRefundAmount(): float
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

        $this->refundAmount = (float)$body->RefundAmount;
        $this->refundCurrency = (int)$body->RefundCurrency;
        $this->refundResult = (string)$body->RefundResult;
        $this->hydrateTransactions($body);
    }
}
