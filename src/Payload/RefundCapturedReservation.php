<?php
namespace Loevgaard\AltaPay\Payload;

use Assert\Assert;
use Loevgaard\AltaPay;
use Money\Money;

class RefundCapturedReservation extends Payload implements RefundCapturedReservationInterface
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
     * @var boolean
     */
    private $allowOverRefund;

    /**
     * @var string
     */
    private $invoiceNumber;

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
            'allow_over_refund' => is_bool($this->allowOverRefund) ? intval($this->allowOverRefund) : null,
            'invoice_number' => $this->invoiceNumber,
            'orderLines' => $this->orderLines,
        ];

        return static::simplePayload($payload);
    }

    public function validate()
    {
        Assert::that($this->transactionId)->string();
        Assert::thatNullOr($this->getAmount())->isInstanceOf(Money::class);
        Assert::thatNullOr($this->reconciliationIdentifier)->string();
        Assert::thatNullOr($this->allowOverRefund)->boolean();
        Assert::thatNullOr($this->invoiceNumber)->string();
        Assert::thatNullOr($this->orderLines)->isArray();
    }

    /**
     * @return string
     */
    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     * @return RefundCapturedReservation
     */
    public function setTransactionId(string $transactionId) : self
    {
        $this->transactionId = $transactionId;
        return $this;
    }

    /**
     * @return Money
     */
    public function getAmount(): ?Money
    {
        return AltaPay\createMoney((string)$this->amountCurrency, (int)$this->amountValue);
    }

    /**
     * @param Money $amount
     * @return RefundCapturedReservation
     */
    public function setAmount(Money $amount) : self
    {
        $this->amountCurrency = $amount->getCurrency()->getCode();
        $this->amountValue = $amount->getAmount();

        return $this;
    }

    /**
     * @return string
     */
    public function getReconciliationIdentifier(): ?string
    {
        return $this->reconciliationIdentifier;
    }

    /**
     * @param string $reconciliationIdentifier
     * @return RefundCapturedReservation
     */
    public function setReconciliationIdentifier(string $reconciliationIdentifier) : self
    {
        $this->reconciliationIdentifier = $reconciliationIdentifier;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAllowOverRefund(): ?bool
    {
        return $this->allowOverRefund;
    }

    /**
     * @param bool $allowOverRefund
     * @return RefundCapturedReservation
     */
    public function setAllowOverRefund(bool $allowOverRefund) : self
    {
        $this->allowOverRefund = $allowOverRefund;
        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceNumber(): ?string
    {
        return $this->invoiceNumber;
    }

    /**
     * @param string $invoiceNumber
     * @return RefundCapturedReservation
     */
    public function setInvoiceNumber(string $invoiceNumber) : self
    {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }
}
