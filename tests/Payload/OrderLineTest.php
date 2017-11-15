<?php

namespace Loevgaard\AltaPay\Payload;

use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;

final class OrderLineTest extends TestCase
{
    public function testGettersSetters()
    {
        $unitPrice = new Money(5050, new Currency('DKK'));
        $taxAmount = new Money(1000, new Currency('DKK'));
        $discount = new Money(1500, new Currency('DKK'));

        $orderLine = new OrderLine('description', 'itemid', 1, $unitPrice);
        $orderLine
            ->setTaxPercent(25)
            ->setTaxAmount($taxAmount)
            ->setUnitCode('unitCode')
            ->setDiscount($discount)
            ->setGoodsType('goodsType')
            ->setImageUrl('imageUrl');

        $this->assertSame('description', $orderLine->getDescription());
        $this->assertSame('itemid', $orderLine->getItemId());
        $this->assertSame(1.0, $orderLine->getQuantity());
        $this->assertEquals($unitPrice, $orderLine->getUnitPrice());
        $this->assertSame(25.0, $orderLine->getTaxPercent());
        $this->assertEquals($taxAmount, $orderLine->getTaxAmount());
        $this->assertSame('unitCode', $orderLine->getUnitCode());
        $this->assertEquals($discount, $orderLine->getDiscount());
        $this->assertSame('goodsType', $orderLine->getGoodsType());
        $this->assertSame('imageUrl', $orderLine->getImageUrl());

        $unitPrice = new Money(6060, new Currency('DKK'));
        $orderLine
            ->setDescription('description2')
            ->setItemId('itemid2')
            ->setQuantity(2)
            ->setUnitPrice($unitPrice);

        $this->assertSame('description2', $orderLine->getDescription());
        $this->assertSame('itemid2', $orderLine->getItemId());
        $this->assertSame(2.0, $orderLine->getQuantity());
        $this->assertEquals($unitPrice, $orderLine->getUnitPrice());

        $goodsTypes = [
            OrderLine::GOODS_TYPE_HANDLING,
            OrderLine::GOODS_TYPE_ITEM,
            OrderLine::GOODS_TYPE_REFUND,
            OrderLine::GOODS_TYPE_SHIPMENT,
        ];

        $this->assertSame($goodsTypes, OrderLine::getGoodsTypes());
    }
}
