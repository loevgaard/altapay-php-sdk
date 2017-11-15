<?php

namespace Loevgaard\AltaPay\Payload;

use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;

final class CaptureReservationTest extends TestCase
{
    public function testGettersSetters()
    {
        $amount = new Money(100, new Currency('DKK'));
        $salesTax = new Money(10000, new Currency('DKK'));

        $captureReservation = new CaptureReservation('transactionid');
        $captureReservation
            ->setAmount($amount)
            ->setSalesTax($salesTax)
            ->setInvoiceNumber('invoice123')
            ->setReconciliationIdentifier('reconciliationIdentifier')
        ;

        $this->assertSame('transactionid', $captureReservation->getTransactionId());
        $this->assertEquals($amount, $captureReservation->getAmount());
        $this->assertEquals($salesTax, $captureReservation->getSalesTax());
        $this->assertSame('invoice123', $captureReservation->getInvoiceNumber());
        $this->assertSame('reconciliationIdentifier', $captureReservation->getReconciliationIdentifier());

        $captureReservation->setTransactionId('transactionid2');

        $this->assertSame('transactionid2', $captureReservation->getTransactionId());
    }
}
