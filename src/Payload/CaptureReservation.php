<?php
namespace Loevgaard\AltaPay\Payload;

use Assert\Assert;

class CaptureReservation extends Payload implements CaptureReservationInterface
{
    use OrderLineArrayTrait;

    /**
     * @var string
     */
    private $transactionId;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $reconciliationIdentifier;

    /**
     * @var string
     */
    private $invoiceNumber;

    /**
     * @var float
     */
    private $salesTax;

    public function __construct(string $transactionId)
    {
        $this->transactionId = $transactionId;
        $this->orderLines = [];
    }

    /**
     * @return array
     */
    public function getPayload() : array
    {
        $payload = [
            'transaction_id' => $this->transactionId,
            'amount' => $this->amount,
            'reconciliation_identifier' => $this->reconciliationIdentifier,
            'invoice_number' => $this->invoiceNumber,
            'sales_tax' => $this->salesTax,
            'orderLines' => $this->orderLines
        ];

        $this->validate();

        return static::simplePayload($payload);
    }

    public function validate()
    {
        Assert::that($this->transactionId)->string();
        Assert::thatNullOr($this->amount)->float();
        Assert::thatNullOr($this->reconciliationIdentifier)->string();
        Assert::thatNullOr($this->invoiceNumber)->string();
        Assert::thatNullOr($this->salesTax)->float();
        Assert::that($this->orderLines)->isArray();
    }

    /**
     * @return string
     */
    public function getTransactionId() : string
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     * @return CaptureReservation
     */
    public function setTransactionId(string $transactionId) : self
    {
        $this->transactionId = $transactionId;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount() : ?float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return CaptureReservation
     */
    public function setAmount(float $amount) : self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getReconciliationIdentifier() : ?string
    {
        return $this->reconciliationIdentifier;
    }

    /**
     * @param string $reconciliationIdentifier
     * @return CaptureReservation
     */
    public function setReconciliationIdentifier(string $reconciliationIdentifier) : self
    {
        $this->reconciliationIdentifier = $reconciliationIdentifier;
        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceNumber() : ?string
    {
        return $this->invoiceNumber;
    }

    /**
     * @param string $invoiceNumber
     * @return CaptureReservation
     */
    public function setInvoiceNumber(string $invoiceNumber) : self
    {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    /**
     * @return float
     */
    public function getSalesTax() : ?float
    {
        return $this->salesTax;
    }

    /**
     * @param float $salesTax
     * @return CaptureReservation
     */
    public function setSalesTax(float $salesTax) : self
    {
        $this->salesTax = $salesTax;
        return $this;
    }
}
