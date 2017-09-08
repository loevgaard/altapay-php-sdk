<?php

namespace Loevgaard\AltaPay\Payload;

use PHPUnit\Framework\TestCase;

final class OrderLineTest extends TestCase
{
    public function testGettersSetters()
    {
        $orderLine = new OrderLine('description', 'itemid', 1, 50.50);
        $orderLine
            ->setTaxPercent(25)
            ->setTaxAmount(10)
            ->setUnitCode('unitCode')
            ->setDiscount(15)
            ->setGoodsType('goodsType')
            ->setImageUrl('imageUrl');

        $this->assertSame('description', $orderLine->getDescription());
        $this->assertSame('itemid', $orderLine->getItemId());
        $this->assertSame(1.0, $orderLine->getQuantity());
        $this->assertSame(50.50, $orderLine->getUnitPrice());
        $this->assertSame(25.0, $orderLine->getTaxPercent());
        $this->assertSame(10.0, $orderLine->getTaxAmount());
        $this->assertSame('unitCode', $orderLine->getUnitCode());
        $this->assertSame(15.0, $orderLine->getDiscount());
        $this->assertSame('goodsType', $orderLine->getGoodsType());
        $this->assertSame('imageUrl', $orderLine->getImageUrl());

        $orderLine
            ->setDescription('description2')
            ->setItemId('itemid2')
            ->setQuantity(2)
            ->setUnitPrice(60.60);

        $this->assertSame('description2', $orderLine->getDescription());
        $this->assertSame('itemid2', $orderLine->getItemId());
        $this->assertSame(2.0, $orderLine->getQuantity());
        $this->assertSame(60.60, $orderLine->getUnitPrice());

        $goodsTypes = [
            OrderLine::GOODS_TYPE_HANDLING,
            OrderLine::GOODS_TYPE_ITEM,
            OrderLine::GOODS_TYPE_REFUND,
            OrderLine::GOODS_TYPE_SHIPMENT,
        ];

        $this->assertSame($goodsTypes, OrderLine::getGoodsTypes());
    }
}
