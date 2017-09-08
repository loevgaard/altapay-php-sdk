<?php
namespace Loevgaard\AltaPay\Response;

use Loevgaard\AltaPay\Response\Partial\Transaction;

class RefundCapturedReservation extends Response
{
    /**
     * @var float
     */
    protected $refundAmount;

    /**
     * @var int
     */
    protected $refundCurrency;

    /**
     * @var string
     */
    protected $result;

    /**
     * @deprecated
     * @var string
     */
    protected $refundResult;

    /**
     * @var Transaction[]
     */
    protected $transactions;

    /**
     * @return float
     */
    public function getRefundAmount(): float
    {
        return $this->refundAmount;
    }

    /**
     * @param float $refundAmount
     * @return RefundCapturedReservation
     */
    public function setRefundAmount(float $refundAmount) : self
    {
        $this->refundAmount = $refundAmount;
        return $this;
    }

    /**
     * @return int
     */
    public function getRefundCurrency(): int
    {
        return $this->refundCurrency;
    }

    /**
     * @param int $refundCurrency
     * @return RefundCapturedReservation
     */
    public function setRefundCurrency(int $refundCurrency) : self
    {
        $this->refundCurrency = $refundCurrency;
        return $this;
    }

    /**
     * @return string
     */
    public function getResult(): string
    {
        return $this->result;
    }

    /**
     * @param string $result
     * @return RefundCapturedReservation
     */
    public function setResult(string $result) : self
    {
        $this->result = $result;
        return $this;
    }

    /**
     * @deprecated
     * @return string
     */
    public function getRefundResult(): string
    {
        return $this->refundResult;
    }

    /**
     * @deprecated
     * @param string $refundResult
     * @return RefundCapturedReservation
     */
    public function setRefundResult(string $refundResult) : self
    {
        $this->refundResult = $refundResult;
        return $this;
    }

    /**
     * @return Transaction[]
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

    /**
     * @param Transaction[] $transactions
     * @return RefundCapturedReservation
     */
    public function setTransactions(array $transactions) : self
    {
        $this->transactions = $transactions;
        return $this;
    }

    /**
     * @param Transaction $transaction
     * @return RefundCapturedReservation
     */
    public function addTransaction(Transaction $transaction) : self
    {
        $this->transactions[] = $transaction;
        return $this;
    }

    protected function init()
    {
        $this->transactions = [];
        $this->refundAmount = (float)$this->xmlDoc->Body->RefundAmount;
        $this->refundCurrency = (int)$this->xmlDoc->Body->RefundCurrency;
        $this->result = (string)$this->xmlDoc->Body->Result;
        $this->refundResult = (string)$this->xmlDoc->Body->RefundResult;

        if (isset($this->xmlDoc->Body->Transactions) &&
            isset($this->xmlDoc->Body->Transactions->Transaction) &&
            !empty($this->xmlDoc->Body->Transactions->Transaction)) {
            foreach ($this->xmlDoc->Body->Transactions->Transaction as $transactionXml) {
                $this->transactions[] = new Transaction($this->getResponse(), $transactionXml);
            }
        }
    }
}
