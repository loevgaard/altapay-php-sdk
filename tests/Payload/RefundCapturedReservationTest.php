<?php

namespace Loevgaard\AltaPay\Payload;

use PHPUnit\Framework\TestCase;

final class RefundCapturedReservationTest extends TestCase
{
    public function testGettersSetters()
    {
        $refundCapturedReservation = new RefundCapturedReservation('transactionid');
        $refundCapturedReservation
            ->setAmount(1)
            ->setInvoiceNumber('invoice123')
            ->setReconciliationIdentifier('reconciliationIdentifier')
            ->setAllowOverRefund(true)
        ;

        $this->assertSame('transactionid', $refundCapturedReservation->getTransactionId());
        $this->assertSame(1.0, $refundCapturedReservation->getAmount());
        $this->assertSame('invoice123', $refundCapturedReservation->getInvoiceNumber());
        $this->assertSame('reconciliationIdentifier', $refundCapturedReservation->getReconciliationIdentifier());
        $this->assertSame(true, $refundCapturedReservation->isAllowOverRefund());

        $refundCapturedReservation->setTransactionId('transactionid1');
        $this->assertSame('transactionid1', $refundCapturedReservation->getTransactionId());
    }

    public function testGetPayload()
    {
        $refundCapturedReservation = new RefundCapturedReservation('transactionid');
        $refundCapturedReservation
            ->setAmount(1)
            ->setInvoiceNumber('invoice123')
            ->setReconciliationIdentifier('reconciliationIdentifier')
            ->setAllowOverRefund(true)
            ->setOrderLines(['orderline'])
        ;

        $this->assertSame([
            'transaction_id' => 'transactionid',
            'amount' => 1.0,
            'reconciliation_identifier' => 'reconciliationIdentifier',
            'allow_over_refund' => 1,
            'invoice_number' => 'invoice123',
            'orderLines' => ['orderline'],
        ], $refundCapturedReservation->getPayload());
    }
}
