<?php
namespace Loevgaard\AltaPay\Payload;

use Assert\Assert;
use Loevgaard\AltaPay;
use Money\Money;

class CaptureReservation extends Payload implements CaptureReservationInterface
{
    use OrderLineArrayTrait;

    /**
     * @var string
     */
    private $transactionId;

    /**
     * @var int
     */
    private $amountValue;

    /**
     * @var string
     */
    private $amountCurrency;

    /**
     * @var string
     */
    private $reconciliationIdentifier;

    /**
     * @var string
     */
    private $invoiceNumber;

    /**
     * @var int
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
        $this->validate();

        $payload = [
            'transaction_id' => $this->transactionId,
            'amount' => AltaPay\floatFromMoney($this->getAmount()),
            'reconciliation_identifier' => $this->reconciliationIdentifier,
            'invoice_number' => $this->invoiceNumber,
            'sales_tax' => AltaPay\floatFromMoney($this->getSalesTax()),
            'orderLines' => $this->orderLines
        ];

        return static::simplePayload($payload);
    }

    public function validate()
    {
        Assert::that($this->transactionId)->string();
        Assert::thatNullOr($this->getAmount())->isInstanceOf(Money::class);
        Assert::thatNullOr($this->reconciliationIdentifier)->string();
        Assert::thatNullOr($this->invoiceNumber)->string();
        Assert::thatNullOr($this->getSalesTax())->isInstanceOf(Money::class);
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
     * @return Money
     */
    public function getAmount() : ?Money
    {
        return AltaPay\createMoney((string)$this->amountCurrency, (int)$this->amountValue);
    }

    /**
     * @param Money $amount
     * @return CaptureReservation
     */
    public function setAmount(Money $amount) : self
    {
        $this->amountValue = $amount->getAmount();
        $this->amountCurrency = $amount->getCurrency()->getCode();

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
     * @return Money
     */
    public function getSalesTax() : ?Money
    {
        return AltaPay\createMoney((string)$this->amountCurrency, (int)$this->salesTax);
    }

    /**
     * @param Money $salesTax
     * @return CaptureReservation
     */
    public function setSalesTax(Money $salesTax) : self
    {
        $this->salesTax = $salesTax->getAmount();
        return $this;
    }
}
