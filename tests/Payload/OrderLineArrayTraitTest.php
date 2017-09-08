<?php

namespace Loevgaard\AltaPay\Payload;

use PHPUnit\Framework\TestCase;

final class OrderLineArrayTraitTest extends TestCase
{
    public function testGettersSetters()
    {
        $obj = $this->getMockForTrait(OrderLineArrayTrait::class);

        $orderLines = [new OrderLine('description', 'itemid', 1, 150.95)];
        $obj->setOrderLines($orderLines);

        $this->assertSame($orderLines, $obj->getOrderLines());
    }

    public function testAddOrderLine()
    {
        $obj = $this->getMockForTrait(OrderLineArrayTrait::class);

        $orderLine = new OrderLine('description', 'itemid', 1, 150.95);
        $obj->addOrderLine($orderLine);

        $this->assertSame([$orderLine], $obj->getOrderLines());
    }

    public function testRemoveOrderLine()
    {
        $obj = $this->getMockForTrait(OrderLineArrayTrait::class);

        $orderLine = new OrderLine('description', 'itemid', 1, 150.95);
        $obj->addOrderLine($orderLine);
        $obj->removeOrderLine($orderLine);

        $this->assertSame([], $obj->getOrderLines());
    }
}
