<?php
namespace Loevgaard\AltaPay\Payload;

use Assert\Assert;

/**
 * @todo create assertions
 */
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
     * @var string
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
            'transaction_id' => $this->getTransactionId(),
            'amount' => $this->getAmount(),
            'reconciliation_identifier' => $this->getReconciliationIdentifier(),
            'invoice_number' => $this->getInvoiceNumber(),
            'sales_tax' => $this->getSalesTax(),
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
        Assert::thatNullOr($this->salesTax)->string();
        Assert::thatNullOr($this->orderLines)->isArray();
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
     * @return string
     */
    public function getSalesTax() : ?string
    {
        return $this->salesTax;
    }

    /**
     * @param string $salesTax
     * @return CaptureReservation
     */
    public function setSalesTax(string $salesTax) : self
    {
        $this->salesTax = $salesTax;
        return $this;
    }
}
