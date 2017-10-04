<?php

namespace Loevgaard\AltaPay\Payload;

use PHPUnit\Framework\TestCase;

final class CaptureReservationTest extends TestCase
{
    public function testGettersSetters()
    {
        $captureReservation = new CaptureReservation('transactionid');
        $captureReservation
            ->setAmount(1)
            ->setSalesTax(100)
            ->setInvoiceNumber('invoice123')
            ->setReconciliationIdentifier('reconciliationIdentifier')
        ;

        $this->assertSame('transactionid', $captureReservation->getTransactionId());
        $this->assertSame(1.0, $captureReservation->getAmount());
        $this->assertSame(100.0, $captureReservation->getSalesTax());
        $this->assertSame('invoice123', $captureReservation->getInvoiceNumber());
        $this->assertSame('reconciliationIdentifier', $captureReservation->getReconciliationIdentifier());

        $captureReservation->setTransactionId('transactionid2');

        $this->assertSame('transactionid2', $captureReservation->getTransactionId());
    }
}
