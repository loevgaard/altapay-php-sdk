<?php
namespace Loevgaard\AltaPay\Payload;

/**
 * @todo create assertions
 */
class CaptureReservation extends Payload implements CaptureReservationInterface
{
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

    /**
     * @var OrderLineInterface[]
     */
    private $orderLines;

    public function __construct(
        string $transactionId,
        ?float $amount = null,
        ?string $reconciliationIdentifier = null,
        ?string $invoiceNumber = null,
        ?string $salesTax = null,
        ?array
        $orderLines = []
    ) {
        $this->setTransactionId($transactionId);
        $this->setAmount($amount);
        $this->setReconciliationIdentifier($reconciliationIdentifier);
        $this->setInvoiceNumber($invoiceNumber);
        $this->setSalesTax($salesTax);
        $this->setOrderLines($orderLines);
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
            'sales_tax' => $this->getSalesTax()
        ];

        // create order lines array
        $orderLines = [];
        foreach ($this->getOrderLines() as $orderLine) {
            $orderLines[] = $orderLine->getPayload();
        }

        if (!empty($orderLines)) {
            $payload['orderLines'] = $orderLines;
        }

        return $this->cleanPayload($payload);
    }

    /**
     * @param OrderLineInterface $orderLine
     * @return CaptureReservation
     */
    public function addOrderLine(OrderLineInterface $orderLine) : self
    {
        $this->orderLines[] = $orderLine;
        return $this;
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
    public function setAmount(?float $amount) : self
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
    public function setReconciliationIdentifier(?string $reconciliationIdentifier) : self
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
    public function setInvoiceNumber(?string $invoiceNumber) : self
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
    public function setSalesTax(?string $salesTax) : self
    {
        $this->salesTax = $salesTax;
        return $this;
    }

    /**
     * @return OrderLineInterface[]
     */
    public function getOrderLines() : ?array
    {
        return $this->orderLines;
    }

    /**
     * @param OrderLineInterface[] $orderLines
     * @return CaptureReservation
     */
    public function setOrderLines(?array $orderLines) : self
    {
        $this->orderLines = $orderLines;
        return $this;
    }
}
