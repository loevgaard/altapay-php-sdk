<?php

namespace Loevgaard\AltaPay\Payload;

use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;

final class RefundCapturedReservationTest extends TestCase
{
    public function testGettersSetters()
    {
        $amount = new Money(100, new Currency('DKK'));

        $refundCapturedReservation = new RefundCapturedReservation('transactionid');
        $refundCapturedReservation
            ->setAmount($amount)
            ->setInvoiceNumber('invoice123')
            ->setReconciliationIdentifier('reconciliationIdentifier')
            ->setAllowOverRefund(true)
        ;

        $this->assertSame('transactionid', $refundCapturedReservation->getTransactionId());
        $this->assertEquals($amount, $refundCapturedReservation->getAmount());
        $this->assertSame('invoice123', $refundCapturedReservation->getInvoiceNumber());
        $this->assertSame('reconciliationIdentifier', $refundCapturedReservation->getReconciliationIdentifier());
        $this->assertSame(true, $refundCapturedReservation->isAllowOverRefund());

        $refundCapturedReservation->setTransactionId('transactionid1');
        $this->assertSame('transactionid1', $refundCapturedReservation->getTransactionId());
    }

    public function testGetPayload()
    {
        $amount = new Money(100, new Currency('DKK'));

        $refundCapturedReservation = new RefundCapturedReservation('transactionid');
        $refundCapturedReservation
            ->setAmount($amount)
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
