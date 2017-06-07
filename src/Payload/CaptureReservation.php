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

    public function __construct($transactionId, $amount = null, $reconciliationIdentifier = null, $invoiceNumber = null, $salesTax = null, array $orderLines = [])
    {
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
    public function getPayload()
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
    public function addOrderLine(OrderLineInterface $orderLine)
    {
        $this->orderLines[] = $orderLine;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     * @return CaptureReservation
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return CaptureReservation
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getReconciliationIdentifier()
    {
        return $this->reconciliationIdentifier;
    }

    /**
     * @param string $reconciliationIdentifier
     * @return CaptureReservation
     */
    public function setReconciliationIdentifier($reconciliationIdentifier)
    {
        $this->reconciliationIdentifier = $reconciliationIdentifier;
        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * @param string $invoiceNumber
     * @return CaptureReservation
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getSalesTax()
    {
        return $this->salesTax;
    }

    /**
     * @param string $salesTax
     * @return CaptureReservation
     */
    public function setSalesTax($salesTax)
    {
        $this->salesTax = $salesTax;
        return $this;
    }

    /**
     * @return OrderLineInterface[]
     */
    public function getOrderLines()
    {
        return $this->orderLines;
    }

    /**
     * @param OrderLineInterface[] $orderLines
     * @return CaptureReservation
     */
    public function setOrderLines($orderLines)
    {
        $this->orderLines = $orderLines;
        return $this;
    }
}
